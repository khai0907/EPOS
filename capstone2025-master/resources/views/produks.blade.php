<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="px-4">
        {{-- Tombol Add Product & Category responsif --}}
        <div class="flex flex-col sm:flex-row gap-4 mt-5">
            <a href="{{ route('produks.create') }}" 
               class="w-full sm:w-auto text-center text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                Add Product
            </a>
            <a href="{{ route('category.index') }}" 
               class="w-full sm:w-auto text-center text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                Category
            </a>
        </div>

        {{-- Table wrapper untuk scroll horizontal di mobile --}}
        <div class="relative overflow-x-auto mt-10">
            <table class="min-w-[600px] w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Product Photo</th>
                        <th scope="col" class="px-4 py-3">Product name</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Stock</th>
                        <th scope="col" class="px-4 py-3">Buy Price</th>
                        <th scope="col" class="px-4 py-3">Sell Price</th>
                        <th scope="col" class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-4 py-2">
                                @if ($produk->photo)
                                    <img src="{{ asset('storage/' . $produk->photo) }}" alt="" class="w-24 h-auto rounded">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                <a href="/produks/{{ $produk->id }}" class="hover:underline">
                                    {{ $produk->name_product }}
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                {{ $produk->category->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $produk->stock ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ 'Rp ' . number_format($produk->buy_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2">
                                {{ 'Rp ' . number_format($produk->sell_price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('produks.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="deleteAlert()"
                                        class="w-full sm:w-auto block text-white bg-red-600 hover:bg-red-900 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-4 py-2 dark:focus:ring-red-900">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

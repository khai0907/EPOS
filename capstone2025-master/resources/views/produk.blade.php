<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="relative overflow-x-auto">
        <div class="flex flex-row">  
            <div class="basis-1/3">
                @if ($produk->photo)
                    <img src="{{ asset('storage/'.$produk->photo) }}" alt="" width="1000">
                @endif
            </div>  
            <div class="basis-2/3">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="row" class="px-6 py-4 font-extrabold text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{ route('produks.edit', $produk->id) }}" class="hover:underline">{{ $produk['name_product'] ?? '-' }}</a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <td class="px-6 py-4">
                                {{ $produk->category->name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Stock
                            </th>
                            <td class="px-6 py-4">
                                {{ $produk['stock'] ?? '-'  }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Buy Price
                            </th>
                            <td class="px-6 py-4">
                                {{ $produk['buy_price'] ?? '-'  }}
                            </td>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Sell Price
                            </th>
                            <td class="px-6 py-4">
                                {{ $produk['sell_price'] ?? '-'  }}
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                <a href="{{ route('produks.edit', $produk->id) }}" class="focus:outline-none text-white bg-yellow-300 hover:bg-yellow-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    <span>Edit</span>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('produks.destroy', $produk->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="focus:outline-none text-white bg-red-600 hover:bg-red-900 focus:ring-4 focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>     
                </table>
            </div>
        </div>
    </div>
        
    </div>
</x-layout>
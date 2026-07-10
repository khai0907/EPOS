<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="relative overflow-x-auto">
        <div class="add-category">
            <a href="{{ route('category.create') }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                <span>Add Category</span>
            </a>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Category name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span> Action </span>
                    </th>
                </tr>
            </thead>
            @foreach ($allcategory as $c)
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('category.edit',$c->id) }}" class="hover:underline">{{ $c['name'] }}</a>
                    </th>
                    <td class="px-6 py-4">
                        <form action="{{ route('category.destroy', $c->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            </tbody>     
            @endforeach
        </table>
    </div>
</x-layout>
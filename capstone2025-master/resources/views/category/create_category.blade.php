<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="space-y-12 pl-5 pr-2">
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Add New Category</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="given-name" placeholder="Input Nama Kategori" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
            </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" onclick="history.back()" class="focus:outline-none text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:ring-red-300 font-bold rounded-lg text-sm mt-2 px-5 py-2 me-2 mb-2 dark:focus:ring-red-900">Cancel</button>
            <button type="submit" onclick="saveAlert()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

</x-layout>
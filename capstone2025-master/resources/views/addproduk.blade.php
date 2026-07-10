<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12 pl-5 pr-2">
            <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Add New Product</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="name_product" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                    <div class="mt-2">
                        <input type="text" name="name_product" id="name_product" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="category" class="block text-sm/6 font-medium text-gray-900">Category</label>
                    <div class="mt-2">
                        <select name="category_id" id="">
                            @foreach ($category as $k)
                                <option value="{{ $k->id }}">{{  $k->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('category.create') }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                            <span>Add Category</span>
                        </a>
                    </div>
                </div>
                
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="buy_price" class="block text-sm/6 font-medium text-gray-900">Product Buy Price</label>
                    <div class="mt-2">
                        <input type="text" name="buy_price" id="buy_price" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="sell_price" class="block text-sm/6 font-medium text-gray-900">Product Sell Price</label>
                    <div class="mt-2">
                        <input type="text" name="sell_price" id="sell_price" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="stock" class="block text-sm/6 font-medium text-gray-900">Stock Product</label>
                    <div class="mt-2">
                        <input type="text" name="stock" id="stock" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>
            </div>


            <div class="col-span-full">
                <label for="product-photo" class="block text-sm/6 font-medium text-gray-900">Product photo</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                   <input type="file" name="photo" id="photo">
                </div>
            </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900"><a href="{{ route('produks.index') }}" class="text-sm font-semibold text-gray-900">Cancel</a></button>
            <button type="submit" onclick="saveAlert()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

</x-layout>
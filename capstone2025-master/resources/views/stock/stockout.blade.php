<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="navbar2">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:outline-hidden focus:ring-inset" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
                        Icon when menu is closed.

                        Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                        Icon when menu is open.

                        Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{ route('stock.create') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Stok Masuk</a>
                        <a href="{{ route('stock.out') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Stok Keluar</a>
                        <a href="{{ route('stock.opname') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Stok Opname</a>
                    </div>
                    </div>
                </div>
                </div>
                </div>
        </div>
    </nav>

     <!-- Mobile menu -->
    <div class="hidden sm:hidden bg-gray-900" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="{{ route('stock.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Stok Masuk</a>
        <a href="{{ route('stock.out') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Stok Keluar</a>
        <a href="{{ route('stock.opname') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Stok Opname</a>
        </div>
    </div>
    </nav>

    </div>
    <div class="max-w-xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Stok Keluar</h1>

        <form method="POST" action="{{ route('stock.storeout') }}" class="space-y-4">
            @csrf

            <div>
                <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Produk</label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="product" 
                        data-dropdown-toggle="dropdown-products" 
                        class="w-full border px-3 py-2 rounded" 
                        placeholder="Cari produk..." 
                        autocomplete="on" 
                        required
                        name="product_name" />
                    <input type="hidden" name="product_id" id="product_id" />

                    <div id="dropdown-products" class="hidden absolute z-10 w-full bg-white rounded shadow max-h-60 overflow-y-auto">
                        <ul class="text-sm text-gray-700" aria-labelledby="dropdown-button">
                            @foreach($produks as $product)
                            <li>
                                <a href="#" 
                                data-id="{{ $product->id }}" 
                                class="block px-4 py-2 hover:bg-gray-100 cursor-pointer product-item">
                                {{ $product->name_product }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <label for="stock" class="block font-medium">Jumlah</label>
                <input type="number" name="stock" id="stock" min="1" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label for="notes" class="block font-medium">Catatan (opsional)</label>
                <input type="text" name="notes" id="notes" class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit" onclick="saveAlert()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </form>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('dropdown-products');
    const input = document.getElementById('product');
    const hiddenInput = document.getElementById('product_id');

    // Tampilkan dropdown saat fokus input
    input.addEventListener('focus', () => dropdown.classList.remove('hidden'));
    input.addEventListener('input', () => {
        const filter = input.value.toLowerCase();
        const items = dropdown.querySelectorAll('.product-item');
        let visibleCount = 0;

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(filter)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if(visibleCount === 0) {
            dropdown.classList.add('hidden');
        } else {
            dropdown.classList.remove('hidden');
        }
    });

    // Saat klik item dropdown
    dropdown.querySelectorAll('.product-item').forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            input.value = item.textContent;
            hiddenInput.value = item.getAttribute('data-id');
            dropdown.classList.add('hidden');
        });
    });

    // Hide dropdown kalau klik di luar
    document.addEventListener('click', e => {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('button[aria-controls="mobile-menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        // Toggle aria-expanded attribute
        const expanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', !expanded);
        });
    }
    });
</script>


</x-layout>

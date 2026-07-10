<x-layout>
    <x-slot:title><h1 class="font-extrabold">DAFTAR LAPORAN</h1></x-slot:title>
        <div class="navbar2">
            <nav class="bg-gray-800 ">
                <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 ">
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
                            <a href="{{ route('laporan.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Data Transaksi</a>
                            <a href="{{ route('report.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Item Terjual</a>
                            <a href="{{ route('report.labarugi') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laba Rugi</a>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
            </div>
        </nav>

        <!-- Mobile menu -->
        <div class="hidden sm:hidden bg-gray-900    " id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('laporan.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Data Transaksi</a>
            <a href="{{ route('report.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Item Terjual</a>
            <a href="{{ route('report.labarugi') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laba Rugi</a>
            </div>
        </div>
        </nav>
        <div class="main">
            {{ $slot }}
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuButton = document.querySelector('button[aria-controls="mobile-menu"]');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');

                // Toggle ikon buka/tutup
                const icons = menuButton.querySelectorAll('svg');
                icons.forEach(icon => icon.classList.toggle('hidden'));

                // Toggle aria-expanded
                const expanded = menuButton.getAttribute('aria-expanded') === 'true';
                menuButton.setAttribute('aria-expanded', !expanded);
            });
        }
    });
</script>

</x-layout>
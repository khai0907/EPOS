<header class="bg-[#a4b0be] w-full sticky">
  <nav class="max-w-7xl mx-auto flex justify-between items-center p-6 lg:px-8">
                <div class="flex lg:flex-1">
                <a href="{{ route('report.chart') }}" class="-m-1.5 p-1.5">
                    <img class="h-20 w-auto" src="{{ asset('storage/ut.png') }}" alt="">
                </a>
             </div>
            
            {{-- Kolom tengah: Teks di tengah navbar --}}
                <div class="flex-1 flex justify-center">
                <h1 class="text-2xl text-black font-bold">{{ $slot }}</h1>
             </div>

                {{-- Kolom kanan: Kosong agar bisa center --}}
                <div class="flex lg:flex-1 justify-end">
                <!-- Kosong atau bisa tambahkan menu nanti -->
                <button type="button" onclick="history.back()" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-bold rounded-lg text-sm mt-2 px-5 py-2 me-2 mb-2 dark:focus:ring-yellow-900">Kembali</button>
                </div>
            </nav>
</header>
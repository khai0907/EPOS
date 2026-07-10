<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  {{-- Form Filter --}}
  <div class="filter px-4 mt-4">
    <form method="GET" action="/filter" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
      <div>
        <label for="start_date" class="block text-sm font-medium">Start Date:</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
      </div>
      <div>
        <label for="end_date" class="block text-sm font-medium">End Date:</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
      </div>
      <div>
        <button type="submit"
                class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white font-semibold hover:bg-indigo-500">
          Filter
        </button>
      </div>
    </form>
  </div>

  {{-- Ringkasan Kartu --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-5 mb-2 px-4">
    
    <div class="bg-yellow-400 rounded-lg text-center shadow-md p-6">
      <div class="flex items-center space-x-1 justify-center mb-2">
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
        </svg>
      </div>
      <h2 class="text-xl font-semibold mb-2 text-center">Produk Terjual</h2>
      <p class="text-black text-center font-semibold">{{ $totalqtysold }}</p>
    </div>
    <div class="bg-green-400 rounded-lg shadow-md p-6">
      <div class="flex items-center space-x-1 justify-center mb-2">
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="flex items-center space-x-1 justify-center mb-2">
        <!-- TEXT -->
        <h2 class="text-xl font-semibold text-black">Pendapatan</h2>
      </div>
      <!-- VALUE -->
      <p class="text-black text-center font-semibold">
        {{ 'Rp ' . number_format($totalNominal, 0, ',', '.') }}
      </p>
    </div>
    <div class="bg-red-400 rounded-lg shadow-md p-6">
      <div class="flex items-center space-x-1 justify-center mb-2">
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
        </svg>
      </div>
      <h2 class="text-xl font-semibold mb-2 text-center">Cost Product</h2>
      <p class="text-black text-center font-semibold">{{ 'Rp ' . number_format($totalCost, 0, ',', '.') }}</p>
    </div>
    <div class="bg-blue-400 rounded-lg shadow-md p-6">
      <div class="flex items-center space-x-1 justify-center mb-2">
        <!-- ICON -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd" />
        </svg>
      </div>
      <h2 class="text-xl font-semibold mb-2 text-center">Profit</h2>
      <p class="text-black text-center font-semibold">{{ 'Rp ' . number_format($profit, 0, ',', '.') }}</p>
    </div>
  </div>

  {{-- Chart --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
    <div id="chart1" class="w-full"></div>
    <div id="chart2" class="w-full"></div>
  </div>

  {{-- Load ApexCharts CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

  <script>
    var options1 = {
      series: [{ name: "Total Transaksi", data: @json($totals) }],
      chart: { height: 350, type: 'line', zoom: { enabled: false } },
      dataLabels: { enabled: false },
      stroke: { curve: 'straight' },
      title: { text: 'Item Sales by Day', align: 'left' },
      grid: { row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.5 }},
      xaxis: { categories: @json($labels) }
    };
    new ApexCharts(document.querySelector("#chart1"), options1).render();

    var options2 = {
      series: [{ name: "Total Transaksi", data: @json($totalsd) }],
      chart: { height: 350, type: 'line', zoom: { enabled: false } },
      dataLabels: { enabled: false },
      stroke: { curve: 'straight' },
      title: { text: 'Sales by Day', align: 'left' },
      grid: { row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.5 }},
      xaxis: { categories: @json($labelsd) }
    };
    new ApexCharts(document.querySelector("#chart2"), options2).render();

    window.addEventListener('keyup', function(e) {
      if(e.key === 'Alt') {
        ApexCharts.exec('chart1', 'updateOptions', options1);
        ApexCharts.exec('chart2', 'updateOptions', options2);
      }
    });

  </script>
</x-layout>

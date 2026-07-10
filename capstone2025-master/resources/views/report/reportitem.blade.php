<x-reportlayout>
    {{-- Form Filter --}}
    <div class="filter px-4 mt-4">
        <form method="GET" action="{{ route('report.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
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

    {{-- Desktop Table --}}
    <div class="max-w-screen-xl mx-auto px-4 mt-6 overflow-x-auto hidden md:block">
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr class="text-left">
                    <th class="px-4 py-2">No Transaksi</th>
                    <th class="px-4 py-2">Nama Produk</th>
                    <th class="px-4 py-2">Qty Sold</th>
                    <th class="px-4 py-2">Cost Product</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemtransaksi as $itmtrx)
                <tr class="text-center border-t">
                    <td class="px-4 py-2">{{ $itmtrx->transaksi->transaction_code }}</td>
                    <td class="px-4 py-2">{{ $itmtrx->product->name_product }}</td>
                    <td class="px-4 py-2">{{ $itmtrx->quantity }}</td>
                    <td class="px-4 py-2">{{ 'Rp ' . number_format($itmtrx->cost, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ 'Rp ' . number_format($itmtrx->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $itmtrx->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden space-y-4 mt-6 px-4">
        @foreach ($itemtransaksi as $itmtrx)
        <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
            <p><strong>No Transaksi:</strong> {{ $itmtrx->transaksi->transaction_code }}</p>
            <p><strong>Nama Produk:</strong> {{ $itmtrx->product->name_product }}</p>
            <p><strong>Qty Sold:</strong> {{ $itmtrx->quantity }}</p>
            <p><strong>Cost Product:</strong> {{ 'Rp ' . number_format($itmtrx->cost, 0, ',', '.') }}</p>
            <p><strong>Price:</strong> {{ 'Rp ' . number_format($itmtrx->price, 0, ',', '.') }}</p>
            <p><strong>Created At:</strong> {{ $itmtrx->created_at->format('d-m-Y H:i') }}</p>
        </div>
        @endforeach
    </div>
</x-reportlayout>

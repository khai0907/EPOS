<x-reportlayout>
    {{-- Filter Form --}}
    <div class="filter px-4 mt-4">
        <form method="GET" action="{{ route('report.trxindex') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
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
                <tr>
                    <th class="px-4 py-2 border">No Transaksi</th>
                    <th class="px-4 py-2 border">Nama Customer</th>
                    <th class="px-4 py-2 border">Cost</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $trx)
                <tr class="text-center border-t">
                    <td class="px-4 py-2 border">{{ $trx->transaction_code }}</td>
                    <td class="px-4 py-2 border">{{ $trx->customer->first_name ?? 'Guest' }} {{ $trx->customer->last_name ?? '' }}</td>
                    <td class="px-4 py-2 border">{{ 'Rp ' . number_format($trx->cost, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ 'Rp ' . number_format($trx->total, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile Cards --}}
    <div class="md:hidden space-y-4 mt-6 px-4">
        @foreach ($transaksi as $trx)
        <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200">
            <p><strong>No Transaksi:</strong> {{ $trx->transaction_code }}</p>
            <p><strong>Nama Customer:</strong> {{ $trx->customer ? $trx->customer->first_name . ' ' . $trx->customer->last_name : 'Guest' }}</p>
            <p><strong>Cost:</strong> {{ 'Rp ' . number_format($trx->cost, 0, ',', '.') }}</p>
            <p><strong>Total:</strong> {{ 'Rp ' . number_format($trx->total, 0, ',', '.') }}</p>
            <p><strong>Created At:</strong> {{ $trx->created_at->format('d-m-Y H:i') }}</p>
        </div>
        @endforeach
    </div>
</x-reportlayout>

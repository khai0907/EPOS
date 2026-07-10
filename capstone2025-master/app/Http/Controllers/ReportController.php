<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\ItemTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil filter tanggal dari query params
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mulai query transaksi
        $query = Transaksi::with('customer');

        // Tambahkan filter tanggal jika ada
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Eksekusi query
        $transaksi = $query->get();

        return view('report.laporan', [
            'title' => 'LAPORAN',
            'transaksi' => $transaksi
        ]);
    }


    public function itemindex(Request $request)
    {
        // Ambil filter tanggal dari query params
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mulai query
        $query = ItemTransaksi::query();

         // Jika ada tanggal mulai, filter data dari tanggal itu ke atas
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        // Jika ada tanggal akhir, filter data sampai tanggal itu
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Ambil data hasil filter
        $itemtransactions = $query->get();

        return view('report.reportitem',[
            'title' => 'LAPORAN ITEM',
            'itemtransaksi' => $itemtransactions,
        ]);
    }

    public function labarugi(Request $request)
    {
        // Ambil filter tanggal dari query params
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Mulai query
        $query = Transaksi::query();

        // Jika ada tanggal mulai, filter data dari tanggal itu ke atas
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        // Jika ada tanggal akhir, filter data sampai tanggal itu
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // Ambil data hasil filter
        $transactions = $query->get();

        // Hitung total pendapatan, biaya, dll sesuai kebutuhan
        $totalTransaksi = $transactions->count();
        $totalPendapatan = $transactions->sum('total');
        $totalBiaya = $transactions->sum('cost');
        $labaBersih = $totalPendapatan - $totalBiaya;

        return view('report.labarugi', compact('transactions', 'totalPendapatan', 'totalBiaya', 'labaBersih'));


        

        // return view('report.labarugi',[
        //     'title' => 'LAPORAN Laba Rugi',
        //     'totalTransaksi' => $totalTransaksi,
        //     'totalNominal' => $totalNominal,
        //     'totalCost' => $totalCost,
        //     'profit' => $profit,
        // ]);
    }

    public function chart()
    {
        $totalNominal = Transaksi::sum('total');
        $totalCost = Transaksi::sum('cost');
        $profit = $totalNominal - $totalCost;
        $totalqtysold = ItemTransaksi::sum('quantity');

        
        //chart1
        $year = date('Y');
        $month = date('m');

        $data = ItemTransaksi::select(
            DB::raw("CAST(strftime('%d', created_at) AS INTEGER) as day"),
            DB::raw('SUM(quantity) as total')
        )
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->groupBy('day')
        ->orderBy('day')
        ->get();


        $labels = range(1, 31);
        $totals = array_fill(0, 31, 0);

        foreach ($data as $item) {
            $totals[$item->day - 1] = (float) $item->total;
        }


        // Data untuk chart2 (per hari)
        $month = date('m');

        $dataDay = Transaksi::select(
            DB::raw("CAST(strftime('%d', created_at) AS INTEGER) as day"),
            DB::raw('SUM(total) as total')
        )
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->groupBy('day')
        ->orderBy('day')
        ->get();

        $labelsd = range(1, 31);
        $totalsd = array_fill(0, 31, 0);

        foreach ($dataDay as $item) {
            $totalsd[$item->day - 1] = (float) $item->total;
        }

        return view('welcome', [
            'title' => 'DASHBOARD',
            'labels' => $labels,
            'totals' => $totals,
            'labelsd' => $labelsd,
            'totalsd' => $totalsd,
            'totalqtysold' => $totalqtysold,
            'totalNominal' => $totalNominal,
            'totalCost' => $totalCost,
            'profit' => $profit,
        ]);
    }

    public function filter()
    {

        $totalNominal = Transaksi::sum('total');
        $totalCost = Transaksi::sum('cost');
        $profit = $totalNominal - $totalCost;
        $transaksi = Transaksi::all();
        $totalqtysold = ItemTransaksi::sum('quantity');


        // Default data
        $labels = $transaksi->groupBy(function ($item) {
            return $item->created_at->format('M Y');
        })->keys();

        $totals = $transaksi->groupBy(function ($item) {
            return $item->created_at->format('M Y');
        })->map(function ($group) {
            return $group->sum('total');
        });

        return view('welcome', [
            'title' => 'Semua Transaksi',
            'transaksi' => $transaksi,
            'labels' => $labels,
            'totals' => $totals,
            'labelsd' => $labels,
            'totalsd' => $totals,
            'totalqtysold' => $totalqtysold,
            'totalNominal' => $totalNominal,
            'totalCost' => $totalCost,
            'profit' => $profit,
        ]);
    }


public function filterreq(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Ambil transaksi terfilter
        $transaksif = Transaksi::with('customer')
            ->when($start_date, fn($q) => $q->whereDate('created_at', '>=', $start_date))
            ->when($end_date, fn($q) => $q->whereDate('created_at', '<=', $end_date))
            ->get();

        // Ambil item transaksi terfilter
        $itemtransaksi = ItemTransaksi::when($start_date, fn($q) => $q->whereDate('created_at', '>=', $start_date))
            ->when($end_date, fn($q) => $q->whereDate('created_at', '<=', $end_date))
            ->get();

        // Total berdasarkan hasil filter
        $totalNominal = $transaksif->sum('total');
        $totalCost = $transaksif->sum('cost');
        $profit = $totalNominal - $totalCost;
        $totalqtysold = $itemtransaksi->sum('quantity');
        $totalTransaksi = $transaksif->count();
        $labaBersih = $totalNominal - $totalCost;

        // Chart 1: Quantity per hari
        $groupedByDayItems = $itemtransaksi->groupBy(fn($item) => $item->created_at->format('d M'))->sortKeys();
        $labels = $groupedByDayItems->keys()->values()->all();
        $totals = $groupedByDayItems->map(fn($group) => $group->sum('quantity'))->values()->all();

        if (empty($labels)) {
            $labels = ['No data'];
            $totals = [0];
        }

        // Chart 2: Nominal per hari
        $groupedByDaySales = $transaksif->groupBy(fn($trx) => $trx->created_at->format('d M'))->sortKeys();
        $labelsd = $groupedByDaySales->keys()->values()->all();
        $totalsd = $groupedByDaySales->map(fn($group) => $group->sum('total'))->values()->all();

        if (empty($labelsd)) {
            $labelsd = ['No data'];
            $totalsd = [0];
        }

        return view('welcome', [
            'title' => 'Filter Transaksi',
            'transaksi' => $transaksif,
            'labels' => $labels,
            'totals' => $totals,
            'labelsd' => $labelsd,
            'totalsd' => $totalsd,
            'totalqtysold' => $totalqtysold,
            'totalNominal' => $totalNominal,
            'totalCost' => $totalCost,
            'profit' => $profit,
            'totalPendapatan' => $totalNominal,
            'totalBiaya' => $totalCost,
            'labaBersih' => $labaBersih,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

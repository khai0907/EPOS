<?php

use App\Http\Controllers\addproduct;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Transaksi;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Models\product;
use App\Models\products;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReportController::class, 'chart'])->name('dashboard');


Route::get('/stok', function () {
    return view('stok',['title'=>'Stok']);
});

Route::get('/laporan', function () {
    return view('report.laporan',['title'=>'Laporan']);
});




// Route Stock
Route::post('/stock/stockout', [StockController::class, 'storeout'])->name('stock.storeout');
Route::get('/stock/stockout', [StockController::class, 'out'])->name('stock.out');
Route::post('/stock/stockopname', [StockController::class, 'storeopname'])->name('stock.storeopname');
Route::get('/stock/stockopname', [StockController::class, 'opname'])->name('stock.opname');

//Route cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/set-customer', [CartController::class, 'setCustomer'])->name('cart.setCustomer');

//report route
Route::get('/report', [ReportController::class, 'itemindex'])->name('report.index');
Route::get('/report/labarugi', [ReportController::class, 'labarugi'])->name('report.labarugi');
Route::get('/report/index', [ReportController::class, 'index'])->name('report.trxindex');


Route::get('/report/chart', [ReportController::class, 'chart'])->name('report.chart');

Route::get('/filter', [ReportController::class, 'filterreq'])->name('filterreq');




Route::resource('produks', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('stock', StockController::class);
Route::resource('transaksi',Transaksi::class);
Route::resource('customer',CustomerController::class);
Route::resource('laporan',ReportController::class);

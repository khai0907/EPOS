<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $stock = Stock::all();
        // return view('stock.stok',[
        //     'title' => 'Stock Masuk',
        //     'stok' => $stock
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Product::with('stock')->get();
        $stock = Stock::all();
        return view('stock.stockin', [
            'title' => 'Stock Masuk',
            'stok' => $stock,
            'produks' => $produks,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
        ]);

        // Update stok produk
        $product = Product::findOrFail($validatedData['product_id']);
        $product->stock += $validatedData['stock'];
        $product->save();

        return redirect()->route('produks.index')->with('success', 'Stok berhasil ditambahkan');
    }

    public function out()
    {
        $produks = Product::with('stock')->get();
        $stock = Stock::all();

        return view('stock.stockout', [
            'title' => 'Stock Keluar',
            'stok' => $stock,
            'produks' => $produks
        ]);
    }

    public function storeout(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
        ]);

        // Update stok produk
        $product = Product::findOrFail($validatedData['product_id']);
        $product->stock -= $validatedData['stock'];
        $product->save();

        return redirect()->route('produks.index')->with('success', 'Stok berhasil Keluarkan');
    }

        public function opname()
    {
        $produks = Product::with('stock')->get();
        $stock = Stock::all();

        return view('stock.stockopname', [
            'title' => 'Stock Opname',
            'stok' => $stock,
            'produks' => $produks
        ]);
    }

    public function storeopname(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock' => 'required|integer|min:0',
        ]); 

        // Update stok produk
        $product = Product::findOrFail($validatedData['product_id']);
        $product->stock = $validatedData['stock'];
        $product->save();

        return redirect()->route('produks.index')->with('success', 'Stok berhasil Di Opname!');
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

    // public function stockIn(Request $request)
    // {
    //     $validated = $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'quantity' => 'required|integer|min:1',
    //         'description' => 'nullable|string',
    //     ]);

    //     $product = Product::findOrFail($validated['product_id']);

    //     // Ambil stok produk, kalau belum ada buat baru
    //     $stock = $product->stock ?? new Stock(['product_id' => $product->id, 'stock' => 0]);

    //     // Tambah stok masuk
    //     $stock->stock += $validated['quantity'];
    //     $stock->save();

    //     return response()->json(['message' => 'Stok masuk berhasil ditambahkan']);
    // }

    // public function StockOut(Request $request)
    // {
    //     //
    // }

    // public function StockOpname(Request $request)
    // {
    //     //
    // }

//     public function createIn()
//     {
//         $products = Product::orderBy('name')->get();
//         return view('stocks.in', compact('products'));
//     }

//     public function storeIn(Request $request)
//     {
//         $data = $request->validate([
//             'product_id' => 'required|exists:products,id',
//             'quantity' => 'required|integer|min:1',
//             'notes' => 'nullable|string',
//         ]);

//         $product = Product::findOrFail($data['product_id']);
//         $product->stock += $data['quantity'];
//         $product->save();

//         StockTransaction::create([
//             'product_id' => $product->id,
//             'type' => 'in',
//             'quantity' => $data['quantity'],
//             'notes' => $data['notes'] ?? null,
//         ]);
// dd($product);
//         return redirect()->route('stocks.index')->with('success', 'Stok masuk berhasil ditambahkan');
//     }

}

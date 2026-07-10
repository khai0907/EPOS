<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Product::with('category','stock')->get();

        return view('produks', [
            'title' => 'Daftar Produk',
            'produks' => $produks,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('addproduk',[
        'title' => 'Detail Produk',  // kirim juga title
        'category'=> $category
    ],
        compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name_product' => 'required',
        'buy_price' => 'required|numeric',
        'sell_price' => 'required|numeric',
        'stock' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
    ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('product-photos', 'public');
            $validatedData['photo'] = $path; // ← tambahkan ini ke data yang disimpan
        };

        Product::create($validatedData);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Product::findOrFail($id);
        return view('produk', compact('produk'),[
            'title' => 'Detail Produk'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Product::find($id);
        $category = Category::all();

        // Kalau tidak ketemu, munculkan 404
        if (!$produk) {
            abort(404);
        }
        return view('produk.edit_produk',[
            'title' => 'Edit Produk',
            'produk' => $produk,
            'category'=> $category
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name_product' => 'required',
            'sell_price' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $produk = Product::findOrFail($id);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('product-photos', 'public');
            $validatedData['photo'] = $path;
        }

        // Sesuaikan key jika field di database tidak sama dengan inputan
        $produk->update([
            'name_product' => $validatedData['name_product'],
            'sell_price' => $validatedData['sell_price'],
            'buy_price' => $validatedData['buy_price'], // pastikan nama field di DB benar
            'category_id' => $validatedData['category_id'],
            'photo' => $validatedData['photo'] ?? $produk->photo,
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Product::findOrFail($id); // ambil produk berdasarkan id, jika tidak ditemukan error 404
        $produk->delete(); // hapus produk

        return redirect()->to('/produks')->with('success', 'Produk berhasil dihapus!');



    }
}

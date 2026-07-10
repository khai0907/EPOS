<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcategory = Category::all();
        return view('category.category', compact('allcategory'),[
            'title' => 'Daftar Kategori',
            'category' => $allcategory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create_category',[
            'title' => 'Buat Kategori Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request -> validate([
            'name' => 'required'
        ]);

        //save data
        Category::create($validatedData);
        
        //redirect
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.detail_category',compact('category'),[
            'title' => 'Detail Kategori'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit_category',compact('category'),[
            'title' => 'Detail Kategori'
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);  // Ambil instance model berdasarkan id
        $category->update($validatedData);      // Panggil update pada instance

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); // ambil produk berdasarkan id, jika tidak ditemukan error 404
        $category->delete(); // hapus produk

        return redirect()->route('category.index');

    }
}

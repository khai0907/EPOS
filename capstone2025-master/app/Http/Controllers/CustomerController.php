<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::all();
        return view('customer.pelanggan',[
            'title' => 'Data Pelanggan',
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create_customer',[
            'title' => 'Masukan Data Customer',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'phone' => 'required|max_digits:13',
        'email' => 'required|email',
        'address' => 'required'
        ]);

        Customer::create($validatedData);
        
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan');
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
        $customer = Customer::findOrFail($id);
         return view('customer.edit_customer',[
            'title' => 'Edit Data Customer',
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

    $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'nullable',
        'phone' => 'nullable|max_digits:13',
        'email' => 'email|nullable',
        'address' => 'nullable'
    ]);

    $customer->update($validatedData);

    return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id); // ambil produk berdasarkan id, jika tidak ditemukan error 404
        $customer->delete(); // hapus produk

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus!');
    }
}

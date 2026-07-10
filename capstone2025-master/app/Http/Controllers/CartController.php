<?php

namespace App\Http\Controllers;

use App\Models\ItemTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Customer;

class CartController extends Controller
{
    public function add(Request $request)
    {
        
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) { 
            $cart[$productId]['quantity']++;
            $price = $product->sell_price; // definisikan dulu
            $cart[$productId]['total'] = $cart[$productId]['quantity'] * $price;
        } else {
            $cart[$productId] = [
                "name" => $product->name_product,
                "quantity" => 1,
                "price" => $product->sell_price,
                "cost" => $product->buy_price,
                "total" => $product->sell_price,
                "photo" => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk ditambahkan ke cart!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart berhasil dikosongkan!');
    }

    public function checkout(Request $request)
    {
        $customer = Customer::all();
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();
        try {
            // 1. Simpan order utama
            $order = Transaksi::create([
                'transaction_code' => $this->generateTransactionCode(),
                'customer_id' => session('customer_id'),
                'cost' => collect($cart)->sum(fn($item)=> $item['cost'] * $item['quantity']),
                'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            ]);
            

            // 2. Simpan item transaksi
            foreach ($cart as $productId => $item) {
                ItemTransaksi::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'cost' => $item['cost'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                // 3. Kurangi stok produk
                $product = Product::find($productId);
                if ($product) {
                    $product->stock = max(0, $product->stock - $item['quantity']);
                    $product->save();
                }
            }

            // 4. Bersihkan session cart
            session()->forget('cart');

            DB::commit();
            return redirect()->route('cart')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    private function generateTransactionCode()
    {
        do {
            $code = mt_rand(1000000000, 9999999999); // 10 digit random number
        } while (Transaksi::where('transaction_code', $code)->exists());

        return $code;
    }

    public function setCustomer(Request $request)
    {
        session(['customer_id' => $request->customer_id]);
        return redirect()->back()->with('success', 'Customer dipilih.');
    }



}



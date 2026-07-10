<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemTransaksi extends Model
{
    protected $table = 'item_transaksi'; 
    protected $fillable = ['order_id', 'product_id', 'price', 'quantity','cost'];

    // Relasi ke Transaksi
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'order_id');
    }

    // Relasi ke Produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}


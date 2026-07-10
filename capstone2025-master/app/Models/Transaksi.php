<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['transaction_code','customer_id','total','cost'];

    // Relasi ke item transaksi (bukan product langsung!)
    public function item_transaksi(): HasMany
    {
        return $this->hasMany(ItemTransaksi::class, 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

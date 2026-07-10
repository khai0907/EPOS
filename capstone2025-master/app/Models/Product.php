<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name_product','sell_price','buy_price','stock','category_id','photo'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function getFormattedSellPriceAttribute()
    {
        return 'Rp ' . number_format($this->sell_price, 0, ',', '.');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

};


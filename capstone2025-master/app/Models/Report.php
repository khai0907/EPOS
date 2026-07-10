<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Report extends Model
{
    public function Transaksi(): hasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'product_id',
        'trx_date',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    const PRODUCT_AVAILABLE = 'disponible';
    const PRODUCT_NO_AVAILABLE = 'no disponible';
    protected $fillable = [
        'name',
        'description',
        'quantify',
        'status',
        'image',
        'seller_id',
    ];

    public function isAvailable()
    {
        return $this->status == Product::PRODUCT_AVAILABLE;
    }
}

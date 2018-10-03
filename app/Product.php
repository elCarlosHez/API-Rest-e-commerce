<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Seller;
use App\Transaction;

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

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

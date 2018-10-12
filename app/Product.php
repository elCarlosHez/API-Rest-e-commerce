<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Seller;
use App\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const PRODUCT_AVAILABLE = 'disponible';
    const PRODUCT_NO_AVAILABLE = 'no disponible';
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'image',
        'status',
        'seller_id',
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $dates = ['deleted_at'];

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
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}

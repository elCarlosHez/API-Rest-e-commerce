<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Seller;
use App\Buyer;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\TransactionsTransformer;

class Transaction extends Model
{
    use SoftDeletes;

    public $transformer = TransactionsTransformer::class;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}

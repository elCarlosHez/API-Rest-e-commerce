<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\CategoryTransformer;

class Category extends Model
{
    use SoftDeletes;

    public $transformer = CategoryTransformer::class;
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

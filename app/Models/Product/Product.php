<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    const PER_PAGE = 40;

    protected $fillable = [
        'name',
        'price',
        'quantity'
    ];

    public function properties(): HasOne
    {
        return $this->hasOne(ProductProperty::class,'product_id', 'id');
    }
}

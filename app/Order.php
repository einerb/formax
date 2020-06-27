<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use App\OrderProduct;

class Order extends Model
{
    protected $fillable = [
        'order',
        'channel',
        'state',
        'value',
        'discount',
        'delivery',
        'dispatch',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}

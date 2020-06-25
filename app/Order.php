<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model
{
    protected $fillable = [
        'id',
        'channel',
        'state',
        'value',
        'discount',
        'delivery',
        'dispatch',
        'product_id',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}

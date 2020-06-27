<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\OrderProduct;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id'
    ];

    public function detailsOrder()
    {
        return $this->hasMany(OrderProduct::class);
    }
}

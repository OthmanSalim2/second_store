<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(
            Product::class,
            'order_items',
            'order_id',
            'product_id',
            'id',
            'id',
        )
            ->withPivot([
                'price', 'quantity', 'product_name'
            ])
            // we use using() method when be pivot table has a model
            ->using(OrderItem::class)
            // this's for change standard name of laravel it's was pivot I put it item
            ->as('item');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault();
    }
}

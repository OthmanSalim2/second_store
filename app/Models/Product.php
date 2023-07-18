<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->belongsToMany(
            Order::class,
            'order_items',
            'product_id',
            'order_id',
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
}

// $product = Product::find(1);

// foreach($product->orders as $order) {
    // this way for access to felid in pivot table
//     echo $order->item->price;
// }

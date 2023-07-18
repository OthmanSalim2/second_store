<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

// here I make extend for pivot because it pivot table
// here without write fillable here consider all felid fillable
// remove autoIncrement must write it
class OrderItem extends Pivot
{
    use HasFactory;
    // here I make extend for pivot and it's remove purple name of table mean order_item and not order_items
    // must say to model name of table it order_items
    protected $table = "order_items";

    public $incrementing = true;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        // I here put withDefault because foreign key possible be nullable
        return $this->belongsTo(Product::class)->withDefault();
    }
}

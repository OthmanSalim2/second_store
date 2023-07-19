<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'amount', 'method', 'payload',
    ];

    // this's wrote if was one of felids table type it json
    protected $casts = [
        'payload' => 'json',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

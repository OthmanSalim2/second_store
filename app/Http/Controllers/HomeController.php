<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::with('category')->limit(8)->latest()->get();

        $top_sellers = Product::with('category')->limit(4)
            ->orderByRaw('(SELECT sum(quantity) from order_items where order_items.product_id = products.id) DESC')
            ->get();
        //other way
        // $top_sellers = Product::with('category')->limit(4)
        //     ->leftJoin('order_items', 'order_items.product_id', '=', 'products.id')
        //     ->orderByRaw('sum(quantity) DESC')
        //     ->get();

        return view('store.home', [
            'featured_products' => $featured,
            'top_sellers' => $top_sellers,
        ]);
    }
}

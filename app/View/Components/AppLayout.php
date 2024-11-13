<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppLayout extends Component
{
    public function render(): View
    {
        $products = Product::with('shop.seller')->get();

        $saleProducts = $products->filter(function ($product) {
            return $product->promotions->isNotEmpty();
        });

        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        $totalAmount = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->where('user_id', Auth::user()->id)
            ->sum('products.unit_price');

        return view('layouts.app', compact('products', 'saleProducts', 'wishlists', 'totalAmount'));
    }
}
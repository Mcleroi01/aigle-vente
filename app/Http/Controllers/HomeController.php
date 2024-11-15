<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::with('shop.seller')->get();
        $categories = CategoryProduct::latest()->get();

        $saleProducts = $products->filter(function ($product) {
            return $product->promotions->isNotEmpty();
        });

        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
            $totalAmount = DB::table('wishlists')
                ->join('products', 'wishlists.product_id', '=', 'products.id')
                ->where('user_id', Auth::user()->id)
                ->sum('products.unit_price');

            // Retourner la vue avec les produits
            return view('home.index', compact('products', 'categories', 'saleProducts', 'wishlists', 'totalAmount'));
        }

        return view('home.index', compact('products', 'categories', 'saleProducts'));
    }
}
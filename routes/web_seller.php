<?php

use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/seller/shops/{shop}/products', [ProductController::class, 'index'])->name('seller.shops.products.index');
    Route::get('/seller/shops', [ShopController::class, 'index'])->name('shops.index');
    Route::get('/seller/shops/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('seller/shops', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/seller/dashboard', [DashboardController::class, 'index'])->name('seller.dashboard');
    Route::get('/dashboard/sales-statistics/{seller}', [DashboardController::class, 'salesStatistics'])->name('dashboard.salesStatistics');
    Route::get('/dashboard/order-statistics/{seller}', [DashboardController::class, 'orderStatistics'])->name('dashboard.orderStatistics');
    Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers.create');
    Route::post('/sellers', [SellerController::class, 'store'])->name('sellers.store');
    Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');
    Route::get('/sellers/{id}', [SellerController::class, 'show'])->name('sellers.show');
    Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])->name('sellers.edit');
    Route::put('/sellers/{id}', [SellerController::class, 'update'])->name('sellers.update');
    Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])->name('sellers.destroy');
});

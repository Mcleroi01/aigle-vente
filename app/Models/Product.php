<?php

namespace App\Models;

use Illuminate\Support\Str;
use Database\Seeders\OrderSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        '_id',
        'name',
        'unit_price',
        'category_produit_id',
        'shop_id',
        'description',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->_id = (string) Str::uuid();
        });
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function category_product(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id');
    }

    public function paniers(): BelongsToMany
    {
        return $this->belongsToMany(Panier::class, 'panier_items', 'product_id', 'panier_id')->withPivot('quantity');
    }
}
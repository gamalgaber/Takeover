<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;

    public function productVariantItem(): HasMany
    {
        return $this->hasMany(ProductVariantItem::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

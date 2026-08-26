<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'last_synced_at' => 'datetime',
    ];

    // علاقة المنتج بالتصنيف
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // علاقة المنتج بالصور المتعددة
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    // علاقة المنتج بالمتغيرات (المقاسات والألوان)
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    // ✅ علاقة المنتج بالتفاصيل (من الداشبورد)
    public function details(): HasOne
    {
        return $this->hasOne(ProductDetail::class);
    }
}
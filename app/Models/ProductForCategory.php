<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductForCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
    ];

    public function productable()
    {
        return $this->morphTo();
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}

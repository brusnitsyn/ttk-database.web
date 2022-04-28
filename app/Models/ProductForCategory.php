<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductForCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'productable_id',
        'productable_type',
        'product_category_id',
    ];
}

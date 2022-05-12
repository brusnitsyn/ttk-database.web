<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
    use HasFactory;

    protected $fillable = [
        'productable_id',
        'productable_type',
        'propertyable_id',
        'propertyable_type',
        'value',
        'dimension',
    ];
}

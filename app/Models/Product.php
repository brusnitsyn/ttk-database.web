<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'article',
        'actual_price',
        'discount_price',
        'weight',
        'image',
        'machine_id',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}

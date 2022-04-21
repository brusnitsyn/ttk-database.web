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
    ];

    /**
     * The machines that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'machine_for_products', 'product_id', 'machine_id');
    }
}

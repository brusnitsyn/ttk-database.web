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
        'brand_id',
        'machine_type_id',
        'machine_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function machineType()
    {
        return $this->belongsTo(MachineType::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperties extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'productableId',
        'productableType',
        'propertiesId',
        'value',
        'dimension',
        'isDimension',
    ];

    public function productable()
    {
        return $this->morphTo();
    }

}

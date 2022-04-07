<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuitableForTechnique extends Model
{
    use HasFactory;

    protected $fillable = [
        'technique_id',
        'product_id'
    ];
}

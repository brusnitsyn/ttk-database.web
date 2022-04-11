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
        'cost',
        'weight',
        'image',
    ];

    public function techniques()
    {
        $this->belongsToMany(Technique::class);
    }
}

<?php

namespace App\Models;

use App\Traits\Eloquent\Uploadable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    use HasFactory, Uploadable;

    protected $fillable = [
        'name',
        'url',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}

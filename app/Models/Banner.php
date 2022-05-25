<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'url'
    ];

    public function image()
    {
        return $this->morphOne(UploadImage::class, 'imageable');
    }
}

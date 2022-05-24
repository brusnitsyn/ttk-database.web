<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'subheader',
        'url'
    ];

    public function images()
    {
        return $this->morphMany(UploadImage::class, 'imageable');
    }
}

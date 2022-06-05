<?php

namespace App\Traits\Eloquent;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;

trait Uploadable
{
    public function upload($file, $storage = 'public', $folder = 'uploads', $filename)
    {
        $image = ImageInt::make($file)->encode('webp', 90);
        Storage::put($storage . '/' . $folder . '/' . $filename, $image->__toString());
        $path = $folder . '/' . $filename;

        if (Storage::disk($storage)->exists($path)) {
            return $path;
        }

        return null;
    }
}

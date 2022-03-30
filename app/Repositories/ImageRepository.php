<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class ImageRepository
{
    public function storeInDisk($disk, $imageable, UploadedFile $file): string
    {
        $image      = ImageManagerStatic::make($file->getContent())->encode('jpg', 90);
        $filename   = md5($file->getContent() . time()) . '.jpg';
        $class      = Str::lower(Str::plural(str_replace('App\\Models\\', '', $imageable::class)));
        $path       = "/$class/$imageable->id/$filename";
        Storage::disk($disk)->put("europharm2$path", $image->stream());

        return $path;
    }

    public function remove($disk, Image $image) {
        Storage::disk($disk)->delete($image->src);
        $image->delete();
    }

    public function createForImageable($imageable, $src) {
        return $imageable->images()->create([
            'src' => $src
        ]);
    }
}

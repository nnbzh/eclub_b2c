<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    public function deleted(Image $image) {
        $links = $image->getTranslations()['src'];
        foreach ($links as $link) {
            Storage::disk('s3')->delete("europharm2$link");
        }
    }
}

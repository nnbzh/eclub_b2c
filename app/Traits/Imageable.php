<?php

namespace App\Traits;

use App\Models\Image;

trait Imageable
{
    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImgSrcAttribute() {
        return $this->image()->first()?->src;
    }

    public function getFullImgSrcAttribute() {
        return config('filesystems.disks.s3.endpoint')."europharm2$this->img_src";
    }
}

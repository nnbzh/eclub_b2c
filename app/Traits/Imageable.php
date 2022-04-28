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

    public function getFirstImgSrcAttribute() {
        if (is_null($this->imgSrc)) {
            return null;
        }

        if (filter_var($this->imgSrc, FILTER_VALIDATE_URL)) {
            return $this->imgSrc;
        }

        return config('filesystems.disks.s3.endpoint')."/europharm2$this->imgSrc";
    }
}

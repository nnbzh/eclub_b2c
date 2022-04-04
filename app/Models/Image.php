<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasTranslations;

    public $translatable = ['src'];

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'lang',
        'src'
    ];

    public function imageable() {
        return $this->morphTo();
    }

    public function getFullImgSrcAttribute() {
        if (is_null($this->src)) {
            return null;
        }

        if (filter_var($this->src, FILTER_VALIDATE_URL)) {
            return $this->src;
        }

        return config('filesystems.disks.s3.endpoint')."/europharm2$this->src";
    }
}

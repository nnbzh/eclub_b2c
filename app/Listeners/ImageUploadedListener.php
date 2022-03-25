<?php

namespace App\Listeners;

use App\Events\ImageUploadedEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadedListener
{
    /**
     * Handle the event.
     *
     * @param ImageUploadedEvent $event
     * @return void
     */
    public function handle(ImageUploadedEvent $event)
    {
        $attributeName = 'src';
        $disk = "s3";
        $destinationPath = strtolower(Str::plural(class_basename($event->model)));

        if (Str::startsWith($event->image ?? '', 'data:image')) {
            $image = \Intervention\Image\ImageManagerStatic::make($event->image)->encode('jpg', 90);
            $filename = md5($image . time()) . '.jpg';
            Storage::disk($disk)->put('europharm2/'. $destinationPath . '/' . $filename, $image->stream());
            $publicDestinationPath = Str::replaceFirst('public/', '', $destinationPath);
            $modelImage = $event->model->image();

            if ($modelImage->exists()) {
                $modelImage = $modelImage->first();

                if (in_array($event->locale, array_keys($modelImage->getTranslations()[$attributeName]))) {
                    Storage::disk($disk)->delete("europharm2".$modelImage?->getTranslation($attributeName, $event->locale));
                }

                $modelImage->setTranslation($attributeName, $event->locale, "/$publicDestinationPath/$filename");
                $modelImage->saveOrFail();
            } else {
                $modelImage->create(['src' => "/$publicDestinationPath/$filename"]);
            }
        } else if (is_null($event->image) && $event->locale) {
            $modelImage = $event->model->image()->first();

            if (! $modelImage) {
                return ;
            }

            Storage::disk($disk)->delete("europharm2".$modelImage?->getTranslation($attributeName, $event->locale));
            $allTranslations = $modelImage->getTranslations()[$attributeName];

            if (count($allTranslations) == 1 && array_key_first($allTranslations) == $event->locale) {
                $modelImage->delete();
            } else {
                $modelImage->forgetTranslation($attributeName, $event->locale);
                $modelImage->saveOrFail();
            }
        }
    }
}

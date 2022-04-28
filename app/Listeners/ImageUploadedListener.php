<?php

namespace App\Listeners;

use App\Events\ImageUploadedEvent;
use App\Helpers\RolePermission;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadedListener
{
    const DISK      = 's3';
    const ATTRIBUTE = 'src';
    /**
     * Handle the event.
     *
     * @param ImageUploadedEvent $event
     * @return void
     */
    public function handle(ImageUploadedEvent $event)
    {
        $image      = $event->binary ?? '';
        $operation  = $event->operation;
        if ($operation == RolePermission::CRUD_CREATE) {
            $destinationPath = $this->getFolderFromImageable($event->data['imageable_type']);
            $filename = $this->storeAndGetFilename($image, $destinationPath);
            Image::create([
                'imageable_id'      => $event->data['imageable_id'],
                'imageable_type'    => $event->data['imageable_type'] ,
                self::ATTRIBUTE     => "/$destinationPath/$filename"
            ]);

            return;
        }
        if ($operation == RolePermission::CRUD_UPDATE) {
            $locale = $event->data['locale'];
            $entry  = $event->data['entry'];
            $translations = $entry->getTranslations()[self::ATTRIBUTE];
            if (Str::startsWith($image ?? '', 'data:image')) {
                $destinationPath = $this->getFolderFromImageable($entry->imageable_type);
                $filename       = $this->storeAndGetFilename($image, $destinationPath);
                if (in_array($locale, array_keys($translations))) {
                    Storage::disk(self::DISK)->delete('europharm2'.$translations[$locale]);
                }
                $entry->setTranslation(self::ATTRIBUTE, $locale, "/$destinationPath/$filename");
                $entry->saveOrFail();
            } elseif (empty($image)) {
                if (count($translations) == 1 && array_key_first($translations) == $locale) {
                    $entry->delete();
                } else {
                    $entry->forgetTranslation(self::ATTRIBUTE, $locale);
                    $entry->saveOrFail();
                    Storage::disk(self::DISK)->delete('europharm2'.$translations[$locale] ?? '');
                }
            }
        }
    }

    private function storeAndGetFilename($image, $folder)
    {
        $extension = Str::substr($image, 0, strpos($image, ';') + 1);
        $extension = Str::replaceFirst('data:image/', '', $extension);
        $extension = Str::replaceFirst(';', '', $extension);
        $image = \Intervention\Image\ImageManagerStatic::make($image)->encode($extension, 90);
        $filename = md5($image . time()) . ".$extension";
        Storage::disk(self::DISK)->put('europharm2/'. $folder . '/' . $filename, $image->stream());

        return $filename;
    }

    private function getFolderFromImageable($namespace) {
        return strtolower(Str::plural(last(explode('\\', $namespace))));
    }
}

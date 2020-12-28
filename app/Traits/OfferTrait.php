<?php


namespace App\Traits;


Trait OfferTrait {
    protected function saveImage($image, $folder) {
        $fileExtension = $image->getClientOriginalExtension();
        $file_name     = time().'.'.$fileExtension;
        $path          = $folder;
        $image -> move($path, $file_name);

        return $file_name;
    }
}

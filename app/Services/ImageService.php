<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeImage($image) {
        // Logic to store the image
        return $image->store('images', 'public');
    }

    public function resize($imagePath, $width, $height, $type = 'contain') {
        $image_old = 'image/'.$imagePath;

        if(!is_file(public_path($image_old))) {
            $image_old = 'image/icons/no_image.png';
        }

        $new_image_path = str_replace('image/', '', $image_old);
        $image_old = public_path($image_old);

        $image_size_text = '-'. $width . 'x' . $height;
        $manager = ImageManager::gd();
        $image = $manager->read($image_old);

        // Get dimensions
        $originalWidth = $image->width();
        $originalHeight = $image->height();

        if($originalWidth != $width || $originalHeight != $height) {

            $scale_dimension = 'w';

            $resize_aspect_ratio = $width / $height;
            $image_aspect_ratio = $originalWidth / $originalHeight;

            if($resize_aspect_ratio < $image_aspect_ratio) {
                $scale_dimension = 'h';
            }

            if($type == 'contain') {
                $width = min($width, $originalWidth);
                $height = min($height, $originalHeight);

                $scale_dimension = ($scale_dimension == 'w') ? 'h' : 'w';

                if($scale_dimension == 'w') {
                    $height = round($width / $image_aspect_ratio);
                } else {
                    $width = round($height * $image_aspect_ratio);
                }
            }
        }

        $image->resize($width, $height);
        // Encode with specific format settings
        $encoded = $image->toWebp(80);

        // Save to cache directory
        $webpPath = 'image/cache/' . substr($new_image_path, 0, strrpos($new_image_path, '.')) . $image_size_text . '.webp';
        Storage::disk('public')->put($webpPath, $encoded);

        return 'storage/'.$webpPath;
    }
}
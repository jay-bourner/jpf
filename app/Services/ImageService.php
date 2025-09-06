<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Resize an image to the specified width and height.
     * -- NEED TO RE-WRITE FOR LARAVEL SPECIFIC
     */
    public function resize($imagePath, $width, $height, $type = 'contain') {
        $image_old = 'image/'.$imagePath;
        return $image_old;

        if(!is_file(public_path($image_old))) {
            return;
        }

        $image_size_text = '-'. $width . 'x' . $height;

        $new_image = 'image/cache/' . substr($imagePath, 0, strrpos($imagePath, '.')) . $image_size_text . '.webp';
        $webpPath = $new_image;

        dd(Storage::disk('public'));

        // if(!is_file('/storage/'.$webpPath)) {
        //     dd("here");
        //     $manager = ImageManager::gd();
        //     $image = $manager->read($image_old);
            
        //     // Get dimensions
        //     $originalWidth = $image->width();
        //     $originalHeight = $image->height();

        //     if($originalWidth != $width || $originalHeight != $height) {

        //         $scale_dimension = 'w';

        //         $resize_aspect_ratio = $width / $height;
        //         $image_aspect_ratio = $originalWidth / $originalHeight;

        //         if($resize_aspect_ratio < $image_aspect_ratio) {
        //             $scale_dimension = 'h';
        //         }

        //         if($type == 'contain') {
        //             $width = min($width, $originalWidth);
        //             $height = min($height, $originalHeight);

        //             $scale_dimension = ($scale_dimension == 'w') ? 'h' : 'w';

        //             if($scale_dimension == 'w') {
        //                 $height = round($width / $image_aspect_ratio);
        //             } else {
        //                 $width = round($height * $image_aspect_ratio);
        //             }
        //         }
        //     }

        //     $image->resize($width, $height);
        //     // Encode with specific format settings
        //     $encoded = $image->toWebp(80);

        //     // Save to cache directory
        //     Storage::disk('public')->put($webpPath, $encoded);
        // }

        return '/storage/'.$webpPath;
    }
}
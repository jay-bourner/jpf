<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        $hero_logo_width = 500;
        $hero_logo_height = 500;
        $hero_image_width = 300;
        $hero_image_height = 300;
        
        $data = array(
            'hero_logo' => [
                'src' => 'image/logos/jpfitnesslogo2025.jpg',
                'alt' => 'JP Fitness Logo',
                'width' => $hero_logo_width,
                'height' => $hero_logo_height,
            ],
            'hero_images' => [
                [
                    'src' => 'image/instructor/instructor-10.jpg',
                    'alt' => 'Instructor 1',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
                [
                    'src' => 'image/instructor/instructor-9.jpg',
                    'alt' => 'Instructor 9',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
                [
                    'src' => 'image/instructor/instructor-13.jpg',
                    'alt' => 'Instructor 13',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
            ],
        );

        return view('components.banner', compact('data'));
    }
}

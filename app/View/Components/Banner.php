<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\ImageService;

class Banner extends Component
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
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
                'src' => $this->imageService->resize('logos/jpfitnesslogo2025.jpg', 500, 500),
                'alt' => 'JP Fitness Logo',
                'width' => $hero_logo_width,
                'height' => $hero_logo_height,
            ],
            'hero_images' => [
                [
                    'src' => $this->imageService->resize('instructor/instructor-10.jpg', 300, 300),
                    'alt' => 'Instructor 1',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
                [
                    'src' => $this->imageService->resize('instructor/instructor-10.jpg', 300, 300),
                    'alt' => 'Instructor 9',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
                [
                    'src' => $this->imageService->resize('instructor/instructor-10.jpg', 300, 300),
                    'alt' => 'Instructor 13',
                    'width' => $hero_image_width,
                    'height' => $hero_image_height,
                ],
            ],
        );

        return view('components.banner', compact('data'));
    }
}

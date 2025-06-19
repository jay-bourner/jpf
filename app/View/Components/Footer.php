<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
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
        $footer = array(
            'columns' => [
                [
                    'header' => 'Find what you\'re looking for?',
                    'links' => [
                        [
                            'name' => 'Home',
                            'href' => '/',
                        ],
                        [
                            'name' => 'Classes',
                            'href' => '/classes',
                        ],
                        [
                            'name' => 'Contact',
                            'href' => '/contact',
                        ],
                    ]
                ],
                [
                    'header' => 'Contact Me',
                    'links' => [
                        [
                            'email' => 'jaime@jpf-movewithme.co.uk'
                        ],
                        [
                            'tel' => '07765 433100'
                        ],
                    ]
                ],
                [
                    'header' => 'Find Me',
                    'class' => 'find-me',
                    'links' => [
                        [
                            // 'name' => 'Facebook',
                            'href' => 'https://www.facebook.com/JaimesFitness',
                            'icon' => 'facebook-logo',
                        ],
                        [
                            // 'name' => 'Instagram',
                            'href' => 'https://www.instagram.com/jpmovewithme',
                            'icon' => 'instagram-logo',
                        ],
                    ]
                ],
                [
                    // 'header' => 'Legal',
                    'class' => 'copyright',
                    'links' => [
                        [
                            'name' => 'Privacy Policy',
                            'href' => '/privacy-policy',
                        ],
                        [
                            'text' => 'Web site designed by Jason Bourner',
                        ],
                        [
                            'text' => '&copy; Copyright all rights reserved JP Fitness '. date('Y'),
                        ],
                    ]
                ]
            ]
        );

        return view('components.footer', compact('footer'));
    }
}

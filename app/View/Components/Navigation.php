<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
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
        $header = array(
            'tagline' => 'Move with me!',
            'navigation' => [
                [
                    'name' => 'Home',
                    'href' => '/',
                    // 'is_active' => true,
                ],
                [
                    'name' => 'Classes',
                    'href' => '/classes',
                    // 'is_active' => true,
                ],
                [
                    'name' => 'Contact',
                    'href' => '/contact',
                    // 'is_active' => true,
                ], 
                [
                    'name' => 'Admin',
                    'href' => '/admin',
                    // 'is_active' => ($isLogged) ? true : false,
                ] 
            ],
        );

        return view('components.navigation', compact('header'));
    }
}

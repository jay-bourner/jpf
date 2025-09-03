<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Navigation extends Component
{
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
                ],
                [
                    'name' => 'Classes',
                    'href' => '/classes',
                ],
                [
                    'name' => 'Contact',
                    'href' => '/contact',
                ],
            ],
        );

        if(Auth::check()) {
            $header['navigation'][] = [
                'name' => 'Admin',
                'href' => '/admin',
            ];
        }

        return view('components.navigation', compact('header'));
    }
}

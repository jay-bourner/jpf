<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSidebar extends Component
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
        $data = array(
            'heading' => 'Welcome, Janet',
            'links' => [
                [
                    'name' => 'Dashboard', 
                    'icon' => 'gauge',
                    'href' => route('admin.index')
                ],
                [
                    'name' => 'Classes', 
                    'icon' => 'barbell',
                    'href' => route('admin.classes')
                ],
                [
                    'name' => 'Venues', 
                    'icon' => 'map-pin-area',
                    'href' => ''
                ],
                [
                    'name' => 'Prices', 
                    'icon' => 'currency-gbp',
                    'href' => ''
                ],
                [
                    'name' => 'Settings', 
                    'icon' => 'gear',
                    'href' => ''
                ],
            ],
        );
        return view('components.admin-sidebar', compact('data'));
    }
}

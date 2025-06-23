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
                    // 'url' => route('admin.dashboard')
                ],
                [
                    'name' => 'Classes', 
                    'icon' => 'barbell',
                    // 'url' => route('admin.settings.index')
                ],
                [
                    'name' => 'Venues', 
                    'icon' => 'map-pin-area',
                    // 'url' => route('admin.users.index')
                ],
                [
                    'name' => 'Prices', 
                    'icon' => 'currency-gbp',
                    // 'url' => route('admin.settings.index')
                ],
                [
                    'name' => 'Settings', 
                    'icon' => 'gear',
                    // 'url' => route('admin.settings.index')
                ],
            ],
        );
        return view('components.admin-sidebar', compact('data'));
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class AdminSidebar extends Component
{
    protected $user;
    /**
     * Create a new component instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user->getAdminUser();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user_name = $this->user['name'];

        $data = array(
            'heading' => 'Welcome, ' . $user_name,
            'links' => [
                [
                    'name' => 'Dashboard', 
                    'icon' => 'gauge',
                    'href' => route('admin.index')
                ],
                [
                    'name' => 'Class Info', 
                    'icon' => 'barbell',
                    // 'href' => route('admin.classes')
                    'dropdown' => [
                        [
                            'name' => 'Classes',
                            'href' => route('admin.classes')
                        ],
                        [
                            'name' => 'Categories',
                            'href' => route('admin.categories')
                        ],
                    ]
                ],
                [
                    'name' => 'Venues', 
                    'icon' => 'map-pin-area',
                    'href' => route('admin.venues')
                ],
                [
                    'name' => 'Prices', 
                    'icon' => 'currency-gbp',
                    'href' => route('admin.prices')
                ],
                [
                    'name' => 'Settings', 
                    'icon' => 'gear',
                    'href' => route('admin.settings')
                ],
            ],
        );
        return view('components.admin-sidebar', compact('data'));
    }
}

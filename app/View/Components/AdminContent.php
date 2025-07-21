<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminContent extends Component
{
    public array $componentAttributes;
    public string $title;
    public array $actions = [];
    
    /**
     * Create a new component instance.
     */
    public function __construct(array $attributes = [])
    {
        $this->componentAttributes = $attributes;
        $this->title = $attributes['title'] ?? 'Admin Content';
        $this->actions = [
            ['label' => 'Create', 'class' => 'add', 'icon' => 'plus'],
            // ['label' => 'Edit', 'class' => 'edit', 'icon' => 'icon-edit'],
            ['label' => 'Delete', 'class' => 'delete', 'icon' => 'trash'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-content');
    }
}

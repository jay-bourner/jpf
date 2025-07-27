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
        $this->actions = $this->componentAttributes['page_actions'] ?? [
            [
                'label' => 'Create',
                'class' => 'add jp-btn-gry',
                'icon' => 'plus',
                'action' => $this->componentAttributes['page_action_create'] ?? ''
            ],
            [
                'label' => 'Disable',
                'class' => 'add jp-btn-gry',
                'icon' => 'prohibit',
                // 'action' => $this->componentAttributes['page_action_create'] ?? ''
            ],
            [
                'label' => 'Delete', 
                'class' => 'delete jp-btn-red', 
                'icon' => 'trash', 
                'action' => $this->componentAttributes['page_action_delete'] ?? ''
            ],
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

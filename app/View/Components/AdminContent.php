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
     *  Create a new component instance.
     */
    public function __construct(array $attributes = [])
    {
        $this->componentAttributes = $attributes;
        $this->title = $attributes['title'] ?? 'Admin Content';
        $this->actions = [
            [
                'label' => 'Create',
                'button' => true,
                'hide' => $this->componentAttributes['action_create']['hide'] ?? true,
                'class' => 'add jp-btn-gry',
                'icon' => 'plus',
                'action' => $this->componentAttributes['action_create']['action']  ?? ''
            ],
            [
                'label' => 'Edit',
                'button' => true,
                'hide' => $this->componentAttributes['action_edit']['hide'] ?? true,
                'class' => 'add jp-btn-gry',
                'icon' => 'pencil',
                'action' => $this->componentAttributes['action_edit']['action']  ?? ''
            ],
            [
                'label' => 'Disable',
                'button' => true,
                'hide' => $this->componentAttributes['action_disable']['hide'] ?? true,
                'class' => 'add jp-btn-gry',
                'icon' => 'prohibit',
                'dataset' => $this->componentAttributes['action_disable']['dataset']  ?? ''
            ],
            [
                'label' => 'Save',
                'button' => true,
                'hide' => $this->componentAttributes['action_save']['hide'] ?? true,
                'class' => 'save jp-btn-gry',
                'icon' => 'save',
                'dataset' => $this->componentAttributes['action_save']['action']  ?? 'submit-form',
            ],
            [
                'label' => 'Cancel',
                'button' => true,
                'hide' => $this->componentAttributes['action_cancel']['hide'] ?? true,
                'class' => 'cancel jp-btn-red',
                'icon' => 'x',
                'action' => $this->componentAttributes['action_cancel']['action']  ?? '',
            ],
            [
                'label' => 'Delete',
                'button' => true, 
                'hide' => $this->componentAttributes['action_delete']['hide'] ?? true,
                'class' => 'delete jp-btn-red', 
                'icon' => 'trash', 
                // 'action' => $this->componentAttributes['action_delete']['action']  ?? '',
                'dataset' => $this->componentAttributes['action_delete']['dataset'] ?? ''
            ],
            [
                'label' => 'Logout',
                'button' => false, 
                'hide' => false,
                'class' => 'logout', 
                'icon' => 'sign-out', 
                'action' =>  route('logout'),
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

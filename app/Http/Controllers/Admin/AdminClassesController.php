<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Models\Venues;
use App\Services\ImageService;

class AdminClassesController extends Controller
{
    protected $imageService;
    protected $categories;
    protected $classes;
    protected $classOptions;
    protected $venues;

    public function __construct(
        ImageService $imageService, 
        Categories $categories, 
        Classes $classes, 
        ClassOptions $classOptions,
        Venues $venues
    ) {
        $this->categories = $categories;
        $this->imageService = $imageService;
        $this->classes = $classes;
        $this->classOptions = $classOptions;
        $this->venues = $venues;
    }

    public function index() {
        $classes = $this->classes->getAllClasses();
        $attributes = [
            'title' => 'Classes',
            'page_action_create' => route('admin.classes.create'),
            'page_action_delete' => route('admin.classes.delete'),
            'classes' => $classes,
        ];

        return view('admin.classes', compact('attributes'));
    }

    public function create() {
        $this->categories = $this->categories->getAllCategories();
        $this->venues = $this->venues->getAllVenues();

        $attributes = [
            'title' => 'Create New Class',
            'categories' => $this->categories ?? [],
            'venues' => $this->venues ?? [],
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'action' => ''
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.classes')
                ]
            ],
        ];
        return view('admin.classes-form', compact('attributes'));
    }

    public function edit($id) {
        $class = $this->classes->getClassById($id);

        if (!$class) {
            return redirect()->route('admin.classes')->with('error', 'Class not found.');
        }

        $attributes = [
            'title' => 'Edit Class',
            'class' => $class,
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'action' => ''
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.classes')
                ]
            ],
        ];
        return view('admin.classes-form', compact('attributes'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Services\ImageService;

class AdminClassesController extends Controller
{
    protected $imageService;
    protected $categories;
    protected $classes;
    protected $classOptions;

    public function __construct(
        ImageService $imageService, 
        Categories $categories, 
        Classes $classes, 
        ClassOptions $classOptions
    ) {
        $this->categories = $categories;
        $this->imageService = $imageService;
        $this->classes = $classes;
        $this->classOptions = $classOptions;
    }

    public function index() {
        $classes = $this->classes->getAllClasses();
        $attributes = [
            'title' => 'Classes',
            'classes' => $classes,
        ];

        return view('admin.classes', compact('attributes'));
    }

    public function create() {
        return view('admin.classes-form');
    }
}

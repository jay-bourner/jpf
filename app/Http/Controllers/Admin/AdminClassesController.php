<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminClassRequest;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Models\Venues;
use App\Services\ImageService;
// use Illuminate\Support\Facades\DB;

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
            // 'page_action_disable' => 'disable-classes',
            // 'page_action_delete' => route('admin.classes.delete'),
            'classes' => $classes,
        ];

        return view('admin.classes', compact('attributes'));
    }

    public function create() {
        $categories = $this->categories->getAllCategories();
        $venues = $this->venues->getAllVenues();

        $attributes = [
            'title' => 'Create New Class',
            'categories' => $categories ?? [],
            'venues' => $venues ?? [],
            'action' => route('admin.classes.store'),
            'method' => 'POST',
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    // 'action' => ''
                    'dataset' => 'submit-form'
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
        $categories = $this->categories->getAllCategories();
        $venues = $this->venues->getAllVenues();

        if (!$class) {
            return redirect()->route('admin.classes')->with('error', 'Class not found.');
        }

        $attributes = [
            'title' => 'Edit Class',
            'class' => $class,
            'categories' => $categories ?? [],
            'venues' => $venues ?? [],
            'action' => route('admin.classes.update', $id),
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
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminClassRequest $request)
    {
        $inputs = $request->validated();

        // dd($inputs);

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token']);

        $result = $this->classes->createClass($data);

        if (isset($result['warning'])) {
            return redirect()->route('admin.classes.create')
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.classes')
            ->with('success', 'Class created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Services\ImageService;

class ClassesController extends Controller
{
    protected $imageService;
    protected $categories;
    protected $classes;
    protected $classOptions;

    public function __construct(ImageService $imageService, 
        Categories $categories, 
        Classes $classes, 
        ClassOptions $classOptions)
    {
        $this->categories = $categories;
        $this->imageService = $imageService;
        $this->classes = $classes;
        $this->classOptions = $classOptions;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            "meta_title" => "Welcome to JP Fitness",
            "meta_description" => "JP Fitness, Move With Me. We are a fitness company that offers a variety of services to help you reach your fitness goals.",
            'header' => 'Classes',
            // 'description' => 'I have a range of classes available to you, both in person and online. See below for timetables of what\'s available. Please visit my contact page if you have any questions.',
            'description' => 'There are a range of classes available to you, Check them out below.',
        );

        $data['categories'] = $this->categories->getAllCategories();
        $data['classes'] = $this->classes->getAllClasses();
        // dd($data['classes']);

        return view('classes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $class = $this->classes->getClassesByName($name);

        dd($class);

        // if (!$class) {
        //     abort(404);
        // }

        // $data = array(
        //     "meta_title" => $class['name'] . " | JP Fitness",
        //     "meta_description" => $class['short_description'],
        //     'header' => $class['name'],
        //     'description' => $class['description'],
        // );

        // $data['class'] = $class;

        // dd($data['class']);
        // $data['options'] = $this->classOptions->getOptionsByClassId($class['id']);

        // return view('classes.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

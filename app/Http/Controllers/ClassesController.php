<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Services\ImageService;
use App\Services\ScheduleService;
use Carbon\Carbon;
use DateTime;

class ClassesController extends Controller
{
    protected $imageService;
    protected $categories;
    protected $classes;
    protected $classOptions;
    protected $scheduleService;

    public function __construct(
        ImageService $imageService, 
        Categories $categories, 
        Classes $classes, 
        ClassOptions $classOptions, 
        ScheduleService $scheduleService
    ) {
        $this->categories = $categories;
        $this->imageService = $imageService;
        $this->classes = $classes;
        $this->classOptions = $classOptions;
        $this->scheduleService = $scheduleService;
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
            'description' => 'There are a range of classes available to you, Check them out below.',
        );

        $data['categories'] = $this->categories->getAllCategories();
        $data['classes'] = $this->classes->getAllClasses();

        // foreach($data['categories'] as $key => $category) {
        //     $image = ($category['image'] != '') ? $category['image'] : 'image/icons/no_image.png';
        //     $image = str_replace('image/', '', $image);
        //     $data['categories'][$key]['image'] = $this->imageService->resize($image, 400, 400);
        // }

        foreach($data['classes'] as $key => $class) {
            $image = ($class['image'] != '') ? $class['image'] : 'image/icons/no_image.png';
            $image = str_replace('image/', '', $image);
            $data['classes'][$key]['image'] = $this->imageService->resize($image, 400, 400);
        }

        return view('classes.index', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        $class = $this->classes->getClassesByName($name);

        if (!$class) {
            abort(404);
        }

        if($class['image'] != '') {
            $image = $class['image'];
            $image = str_replace('image/', '', $image);
            $class['image'] = $this->imageService->resize($image, 1000, 1000);
        }

        $data = array(
            'single_page' => true,
            "meta_title" => $class['name'] . " | JP Fitness",
            "meta_description" => $class['short_description'],
            'header' => $class['name'],
            'short_description' => $class['short_description'],
            'description' => $class['description'],
            'image' => $class['image'],
            'alt' => $class['image_description'],
            'notes' => $class['notes'],
            'options' => $class['options'],
            'no_image' => $class['no_image'],
            'start_date' => $class['start_date'],
            'status' => $class['status'],
        );

        $data['schedule'] = $this->scheduleService->makeSchedule($class['start_date'], $class['options']);

        return view('classes.index', compact('data'));
    }
}

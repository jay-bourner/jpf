<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Services\ImageService;
use Carbon\Carbon;
use DateTime;

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
            // 'class' => $class,
        );

        $data['schedule'] = $this->makeSchedule($class['start_date'], $class['options']);

        return view('classes.index', compact('data'));
    }

    /**
     * Make a schedule for a class based on options frequency, day and start/end time.
     * --NEEDS TO BE MOVED TO A SERVICE CLASS--
     */
    public function makeSchedule($start_date, $classOptions, $limit = 4)
    {
        $schedule = array();

        // start date of the class
        $beginning = new DateTime($start_date);
        $today_date = new DateTime();

        $beginningDate = '';
        $beginningDay = '';

        //get the starting date and day of the class
        if($beginning > $today_date) {
            $beginningDate = clone $beginning;
        } else {
            $beginningDate = clone $today_date;
        }
        $beginningDay = $beginningDate->format('l');

        foreach($classOptions as $option) {
            $dayOfWeek = $option['day'];        // e.g., 'Monday'
            $startTime = $option['start_time']; // e.g., '10:00:00'
            $endTime = $option['end_time'];     // e.g., '11:00:00'
            $frequency = $option['frequency'];  // e.g., 'weekly', 'bi-weekly', 'monthly'

            if($dayOfWeek === $beginningDay) {
                // If the class day is today, schedule it for today
                $nextDate = clone $beginningDate;
            } else {
                // Otherwise, find the next occurrence of the class day
                $nextDate = $this->getNextDate($beginningDate->format('Y-m-d'), $dayOfWeek);
            }

            // create first instance of schedule
            $schedule[$option['venue']][] = [
                'date' => Carbon::parse($nextDate)->format('F j, Y') . " (". $nextDate->format('l') .")",
                'time' => Carbon::parse($startTime)->format('g:i A') . " - " . Carbon::parse($endTime)->format('g:i A')
            ];

            // Generate subsequent dates based on frequency and $limit variable passed into function
            for ($i = 0; $i < $limit; $i++) {
                $date = $nextDate;

                switch ($frequency) {
                    case 'weekly':
                        $date->modify('+1 week');
                        break;
                    case 'bi-weekly':
                        $date->modify('+2 weeks');
                        break;
                    case 'monthly':
                        $date->modify('+1 month');
                        break;
                    // case 'custom':
                    //     // For custom frequency, let's assume it's every 10 days for this example
                    //     $date->modify('+10 days');
                    //     break;
                    default:
                        // If frequency is unknown, default to weekly
                        $date->modify('+1 week');
                        break;
                }
                
                $schedule[$option['venue']][] = [
                    'date' => Carbon::parse($date)->format('F j, Y') . " (". $date->format('l') .")",
                    'time' => Carbon::parse($startTime)->format('g:i A') . " - " . Carbon::parse($endTime)->format('g:i A')
                ];
            }
        }

        return $schedule;
    }

    function getNextDate($start, $dayOfWeek) {
        $date = new DateTime($start);
        $date->modify('next ' . $dayOfWeek);
        return $date;
    }
}

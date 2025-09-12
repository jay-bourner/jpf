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
use App\Services\schema;

class ClassesController extends Controller
{
    protected $imageService;
    protected $categories;
    protected $classes;
    protected $classOptions;
    protected $scheduleService;
    protected $schema;

    public function __construct(
        ImageService $imageService, 
        Categories $categories, 
        Classes $classes, 
        ClassOptions $classOptions, 
        ScheduleService $scheduleService,
        schema $schema
    ) {
        $this->categories = $categories;
        $this->imageService = $imageService;
        $this->classes = $classes;
        $this->classOptions = $classOptions;
        $this->scheduleService = $scheduleService;
        $this->schema = $schema;
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

        $schema_data = [
            [
                '@type' => 'LocalBusiness',
                'name' => 'JP Fitness',
                'description' => $class['description'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => "Rudham's District Village Hall",
                    'addressLocality' => 'East Rudham',
                    'postalCode' => 'PE31 8RF',
                    'addressCountry' => 'GB'
                ],
                'telephone' => '07765 433100',
                'url' => 'https://www.jpf-movewithme.co.uk/',
                'openingHoursSpecification' => 'Mo,Tu,We,Th,Fr 09:00-17:00',
                'makesOffer' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => $class['name'],
                            'description' => $class['short_description'],
                        ]
                    ]
                ]
            ]
        ];

        $schema = $this->schema->build($schema_data);
        $data['schema'] = $schema;

        $data['schedule'] = $this->scheduleService->makeSchedule($class['start_date'], $class['options']);

        return view('classes.index', compact('data'));
    }
}


// *** a variation of opening times and dates when they vary ***
// {
//   "@context": "https://schema.org",
//   "@type": "LocalBusiness",
//   "name": "Your Business Name",
//   "openingHoursSpecification": [
//     {
//       "@type": "OpeningHoursSpecification",
//       "dayOfWeek": [
//         "Monday",
//         "Tuesday",
//         "Wednesday",
//         "Thursday",
//         "Friday"
//       ],
//       "opens": "09:00",
//       "closes": "21:00"
//     },
//     {
//       "@type": "OpeningHoursSpecification",
//       "dayOfWeek": [
//         "Saturday",
//         "Sunday"
//       ],
//       "opens": "10:00",
//       "closes": "23:00"
//     },
//     {
//       "@type": "OpeningHoursSpecification",
//       "dayOfWeek": "Saturday",
//       "opens": "18:00",
//       "closes": "03:00",
//       "validFrom": "2025-12-21", // Example start date for holiday hours
//       "validThrough": "2025-12-27"  // Example end date for holiday hours
//     }
//   ]
// }
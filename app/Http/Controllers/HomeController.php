<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prices;
use App\Services\ImageService;
use App\Services\schema;

class HomeController extends Controller
{
    protected $imageService;
    protected $prices;
    protected $schema;

    public function __construct(ImageService $imageService, Prices $prices, schema $schema)
    {
        $this->imageService = $imageService;
        $this->prices = $prices;
        $this->schema = $schema;
    }
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $payg_price = $this->prices->getPriceByType('payg');

        $data = array(
            'meta_title' => 'Get Active and Have Fun! Fitness Classes for Everyone around Fakenham',
            // 'meta_description' => '',
            "title" => "Home",
            'mission_cards' => [
                [
                    'title' => 'Fitness for All',
                    'class' => 'mission',
                    'description' => 'Join our community to improve your fitness, nutrition and overall wellness. You\'ll find a safe and nurturing environment where you can work at your own level and pace, and receive evidence-based advice - no fads here!',
                ],
                [
                    'title' => 'In-Person or Online',
                    'class' => 'journey',
                    'description' => 'Book yourself into classes in West and North Norfolk for in-person support, fun and comradery. Not local? Log onto an online class and benefit from exercising in your own time and own home.',
                ],
                [
                    'title' => 'Women\'s Health Specialist',
                    'class' => 'values',
                    'description' => 'Discover effective exercises, nutrition and supplements to support you through all stages of menopause and beyond. Delivered online, you\'ll easily fit these programs into your already busy schedule.',
                ]
            ],
            'intro' => [
                [
                    'left' => [
                        'image' => $this->imageService->resize('instructor/jaime-about-me.jpg', 500, 500),
                        'alt' => 'Instructor 1',
                        'header' => 'Welcome to Putting Your Fitness & Wellness First',
                        'paragraphs' => [
                            'Hi, I\'m Jaime, and as a lady in her 40s,  mum to two young children, a wife and a business owner, I\'m no stranger to putting everyone else first and myself last. However, as I approach my half-century (scary now I write it!) I realise the importance of focusing on my health and wellbeing. I make my lifestyle, fitness and wellness choices based on increasing longevity. I want to be able to move freely and stay strong and physically independent into my later years. And I now make it my mission to help you do the same.',
                            '<b>My credentials</b><br> My passion for fitness and exercise began in my 20s when I became an entertainer and dancer. For the last ten years, I have been passionate about helping my local community as a fitness instructor, nutritional advisor, and women\'s health and wellbeing specialist.',
                            '<b>My offering</b><br> You\'ll find a diverse range of community fitness classes in West and North Norfolk. Online, there are fitness and nutrition programs tailored for both men and women. Browse the timetable to find your perfect class.',
                        ]
                    ],
                    'right' => [
                        'header' => 'Classes Include',
                        'class' => 'classes-list',
                        'list' => [
                            'Lift Lean',
                            'Dance Fitness',
                            'Fitness Pilates',
                            'Walkfit',
                            'Lift Lean Seniors',
                        ],
                        'button' => [
                            'text' => 'View All Classes',
                            'link' => '/classes'
                        ],
                        'price' => $payg_price['price'],
                    ],
                ]
            ],
            'testimonials' => [
                [
                    'header' => 'Testimonials',
                    'sub_header' => 'Dont take my word for it, see what others have to say...',
                    'quotes' => [
                        [
                            'quote' => ['I\'ve never excelled at sport but I\'ve been going to Jaime\'s Fitness Pilates classes for over two years and I\'ve noticed a significant steady improvement in my strength, balance, posture and fitness as well as my general mental wellbeing. I can now do a range of exercises that I couldn\'t do when I first started. Jaime is talented, passionate and motivational - she tailors exercises to suit every ability and always makes classes fun so you\'re never clock-watching during the session and leave feeling energised and proud of what you have accomplished!'],
                            'author' => 'Kat. P'
                        ],
                        [
                            'quote' => [ 'I hit 40 in July, beforehand I felt sluggish and not very motivated within myself, I was also getting a bit out of puff when doing activities with the kids.', 'Since keeping up with Jaimes Pilates and Lift and Lean classes it\'s helped me to keep the motivation going! I feel stronger, leaner and more confident in myself, not just in how I look but how I feel too.' ],
                            'author' => 'Carla. P'
                        ],
                        [
                            'quote' => ['The Fit Female Project totally surpassed my expectations. There was so much content which made it great value for money. Aimed at peri and post-menopausal women it included lots of advice on what to expect and ways to alleviate the symptoms through exercise, nutrition, HRT, supplements etc. Jaime delivered the programme in her usual friendly, professional and inspirational way. I feel motivated to continue on this journey towards a healthier, fitter, happier me and wished I had done this programme 20 years ago! I averaged 11,800 steps a day over the four weeks, did 21 classes, lost 6lbs in weight and 4 cm off my hips'],
                            'author' => 'Nancy. W'
                        ]
                    ]
                ]
            ],
            'images_section' => [
                'header' => 'Gallery',
                'sub_header' => 'Take a look at some of the fun we have in our classes!',
                'images' => [
                    [
                        'src' => $this->imageService->resize('gallery/dark-neon.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/lift-lean.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/long-hall-1.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/long-hall-2.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/long-hall-3.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/seated.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/grassy-workout.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/tent-workout.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/stability-ball.jpg', 500, 500),
                        'alt' => ''
                    ],
                    [
                        'src' => $this->imageService->resize('gallery/equipment.jpg', 500, 500),
                        'alt' => ''
                    ],
                ]
            ],
            'qualifications' => [
                'header' => 'Qualifications',
                'text_content' => [
                    [
                        'para' => 'I am a qualified Fitness Instructor, Nutritional Advisor, and Women\'s Health & Wellbeing Specialist with over a decade of experience. I hold the following qualifications:',
                        'list' => [
                            'Level 2 Exercise to music from Lifetime training.',
                            'Fitness Pilates and Lift Lean with Choreography To Go',
                            'Fitsteps dance fitness training with FitSteps Official',
                            'Level 3 Nutrition for Exercise and health with Active IQ.',
                            'My qualifications are CIMSPA approved.'
                        ]
                    ]
                ],
                'images' => [
                    [
                        'src' => $this->imageService->resize('certificates/fitness-pilates-2025.png', 500, 500),
                        'alt' => 'Qualifications',
                    ],
                    [
                        'src' => $this->imageService->resize('certificates/lift-lean-cert.jpeg', 500, 500),
                        'alt' => 'Qualifications',
                    ],
                ]
            ]
        );

        $schema_data = [
            [
                '@type' => 'LocalBusiness',
                'name' => 'JP Fitness',
                'image' => 'https://www.jpf-movewithme.co.uk/public/image/logos/jpfitnesslogo2025-black-bg.png',
                'url' => 'https://www.jpf-movewithme.co.uk/',
                'telephone' => '07765 433100',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => "18 Eye Lane",
                    'addressLocality' => 'East Rudham',
                    'postalCode' => 'PE31 8RJ',
                    'addressCountry' => 'GB'
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => '52.82336888694812',
                    'longitude' => '0.7174094617305428'
                ],
                'priceRange' => '£9.00',
                'openingHoursSpecification' => 'Mo,Tu,We,Th,Fr 09:00-17:00',
                'paymentAccepted' => 'Cash',
                'areaServed' => [
                    'East Rudham',
                    'Ingoldisthorpe',
                    'Heacham',
                ],
            ]
        ];

        $schema = $this->schema->build($schema_data);
        $data['schema'] = $schema;

        return view('home.index', compact('data'));
    }
}

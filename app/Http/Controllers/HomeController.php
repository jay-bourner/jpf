<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prices;

class HomeController extends Controller
{
    public function index() {
        $payg_price = Prices::where('type', 'payg')->first();
        // dd($payg_price);

        $data = array(
            'meta_title' => 'Welcome to JP Fitness',
            'meta_description' => 'Welcome to JP Fitness',
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
            'classes' => [
                [
                    'left' => [
                        'image' => 'image/instructor/jaime-about-me.jpg',
                        'alt' => 'Instructor 1',
                        'header' => 'Welcome to Putting Your Fitness & Wellness First',
                        'paragraphs' => [
                            'Hi, I\'m Jaime, and as a lady in her 40s,  mum to two young children, a wife and a business owner, I\'m no stranger to putting everyone else first and myself last. However, as I approach my half-century (scary now I write it!) I realise the importance of focusing on my health and wellbeing. I make my lifestyle, fitness and wellness choices based on increasing longevity. I want to be able to move freely and stay strong and physically independent into my later years. And I now make it my mission to help you do the same.',
                            '<b>My credentials</b><br> My passion for fitness and exercise began in my 20s when I became an entertainer and dancer. For the last ten years, I have been passionate about helping my local community as a fitness instructor, nutritional advisor, and women\'s health and wellbeing specialist.',
                            '<b>My offering</b><br> You\'ll find a diverse range of community fitness classes in West and North Norfolk. Online, there are fitness and nutrition programs tailored for both men and women. Browse the timetable to find your perfect class.',
                        ]
                    ],
                    'middle' => [
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
                        'price' => $payg_price,
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
                        'src' => 'image/gallery/dark-neon.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/lift-lean.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/long-hall-1.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/long-hall-2.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/long-hall-3.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/seated.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/grassy-workout.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/tent-workout.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/stability-ball.jpg',
                        'alt' => ''
                    ],
                    [
                        'src' => 'image/gallery/equipment.jpg',
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
                        'src' => 'image/certificates/fitness-pilates-2025.png',
                        'alt' => 'Qualifications' ,
                    ],
                    [
                        'src' => 'image/certificates/lift-lean-cert.jpeg',
                        'alt' => 'Qualifications' ,
                    ],
                ]
            ]
        );
        

        return view('home.index', compact('data'));
    }
}

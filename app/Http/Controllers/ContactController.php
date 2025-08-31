<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;
use App\Services\ImageService;
use App\Mail\ContactEmail;

class ContactController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            "meta_title" => "Welcome to JP Fitness",
            "meta_description" => "JP Fitness, Move With Me. We are a fitness company that offers a variety of services to help you reach your fitness goals.",
            'image' => [
                'src' => $this->imageService->resize('contact/Jaime-chilling.jpg', 750, 750),
                'alt' => 'Contact Us'
            ],
        );

        return view('contact.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function submit(ContactFormRequest $request)
    {
        $inputs = $request->validated();

        // Send email
        $contactData = [
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'number' => $inputs['number'] ?? 'N/A',
            'message' => nl2br($inputs['message']),
        ];

        Mail::send(new ContactEmail($contactData));

        return redirect()->route('contact.index')
            ->with('success', 'Your message has been sent successfully!');
    }
}

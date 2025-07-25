<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\Venues;
use App\Http\Requests\AdminVenuesRequest;

class AdminVenuesController extends Controller
{
    protected $imageService;
    protected $venues;
    

    public function __construct(ImageService $imageService, Venues $venues) {
        $this->imageService = $imageService;
        $this->venues = $venues;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = [
            'title' => 'Venues',
            'page_action_create' => route('admin.venues.create'),
            'page_action_delete' => route('admin.venues.delete'),
            'venues' => $this->venues->getAllVenues(),
        ];
        return view('admin.venues', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $attributes = [
            'title' => 'Create New Venue',
            'action' => route('admin.venues.store'),
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'method' => 'POST',
                    'dataset' => 'submit-form'
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.venues')
                ]
            ],
        ];
        return view('admin.venues-form', compact('attributes'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venue = $this->venues->getVenuesById($id);

        if (!$venue) {
            return redirect()->route('admin.venues')->with('error', 'Venue not found.');
        }

        $attributes = [
            'title' => 'Edit Venue',
            'venue' => $venue,
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
                    'action' => route('admin.venues')
                ]
            ],
        ];
        return view('admin.venues-form', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminVenuesRequest $request)
    {
        // $validated = $request->validated();
        // $this->venues->createVenue($validated);
        return redirect()->route('admin.venues')->with('success', 'Venue created successfully.');
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

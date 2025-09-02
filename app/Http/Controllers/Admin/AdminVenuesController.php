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
            'venues' => $this->venues->getAllVenues(),
            'action_create' => ['action' => route('admin.venues.create')],
            'action_disable' => ['dataset' => 'disable-venues'],
            'action_save' => ['hide' => true],
            'action_cancel' => ['hide' => true],
            'action_delete' => ['dataset' => 'delete-venues'],
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
            'action_create' => ['hide' => true],
            'action_disable' => ['hide' => true],
            'action_save' => ['dataset' => 'submit-form'],
            'action_cancel' => ['action' => route('admin.venues')],
            'action_delete' => ['hide' => true],
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
            'method' => 'POST',
            'second_method' => 'PUT',
            'action' => route('admin.venues.update', $id),
            'action_create' => ['hide' => true],
            'action_disable' => ['hide' => true],
            'action_save' => ['dataset' => 'submit-form'],
            'action_cancel' => ['action' => route('admin.venues')],
            'action_delete' => ['hide' => true],
        ];
        return view('admin.venues-form', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminVenuesRequest $request)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token']);

        $result = $this->venues->createVenue($data);

        if(isset($result['warning'])) {
            return redirect()->route('admin.venues.create')
            ->withErrors($result['warning']);
        }

        return redirect()->route('admin.venues')
            ->with($result['success']);
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $venue = $this->venues->getVenuesById($id);

        if(!$venue) {
            return redirect()->route('admin.venues')->with('error', 'Class not found.');
        }

        $attributes = [
            'title' => ucwords($venue['name']),
            'venue' => $venue,
            // 'page_actions' => [
            //     [
            //         'label' => 'Save',
            //         'class' => 'save jp-btn-gry',
            //         'icon' => 'save',
            //         'action' => ''
            //     ],
            //     [
            //         'label' => 'Cancel',
            //         'class' => 'cancel jp-btn-red',
            //         'icon' => 'x',
            //         'action' => route('admin.venues')
            //     ]
            // ],
        ];

        // dd($attributes);
        return view('admin.venue-view', compact('attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminVenuesRequest $request, string $id)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->venues->updateVenue($id, $data);

        if(isset($result['warning'])) {
            return redirect()->route('admin.venues.edit', ['id' => $id])
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.venues')
            ->with($result['success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * API method for venues
     */
    public function apiIndex()
    {
        $result = array();
        $id = request()->route('id');

        if($id) {
            $venue = $this->venues->getVenuesById($id);

            if (!$venue) {
                $result = ['error' => 'No venues found.'];
            } else {
                $result = $venue;
            }
        } else {
            $venues = $this->venues->getAllVenues();
            $result = $venues;
        }

        return response()->json($result);
    }
}

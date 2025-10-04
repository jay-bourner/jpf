<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminClassOptionRequest;
use Illuminate\Http\Request;
use App\Http\Requests\AdminClassRequest;
use App\Models\Classes;
use App\Models\ClassOptions;
use App\Models\Categories;
use App\Models\Venues;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        $this->middleware('auth');
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
            'action_create' => ['hide' => false, 'action' => route('admin.classes.create')],
            'action_disable' => ['hide' => false, 'dataset' => 'disable-classes'],
            'action_delete' => ['hide' => false, 'dataset' => 'delete-classes'],
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
            'action_save' => ['hide' => false, 'dataset' => 'submit-form'],
            'action_cancel' => ['hide' => false, 'action' => route('admin.classes')],
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
            'method' => 'POST',
            'second_method' => 'PUT',
            'action' => route('admin.classes.update', $id),
            'action_save' => ['hide' => false, 'dataset' => 'submit-form'],
            'action_cancel' => ['hide' => false, 'action' => route('admin.classes')],
        ];
        return view('admin.classes-form', compact('attributes'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminClassRequest $request)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token']);
            
        if($data['image']) {
            $filename = $data['image']->getClientOriginalName();
            $data['image']->move('image/uploads', $filename);
            $data['image'] = '/image/uploads/' . $filename;
        }

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
    public function view(string $id)
    {
        $class = $this->classes->getClassById($id);

        if(!$class) {
            return redirect()->route('admin.classes')->with('error', 'Class not found.');
        }

        $attributes = [
            'title' => ucwords($class['name']),
            'action_edit' => ['hide' => false, 'action' => route('admin.classes.edit', $id)],
            'action_delete' => ['hide' => false, 'action' => route('admin.classes.delete', $id)],
            'class' => $class,
        ];

        return view('admin.class-view', compact('attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminClassRequest $request, string $id)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        if(isset($data['image'])) {
            $filename = $data['image']->getClientOriginalName();
            $data['image']->move('image/uploads', $filename);
            $data['image'] = '/image/uploads/' . $filename;
        }

        $result = $this->classes->updateClass($id, $data);

        if (isset($result['warning'])) {
            return redirect()->route('admin.classes.edit')
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.classes')
            ->with('success', 'Class created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->classes->deleteClass($id);
        
        if (isset($result['warning'])) {
            return redirect()->route('admin.classes')
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.classes')
            ->with('success', 'Class created successfully!');
    }

    public function apiIndex() {
        $result = array();
        $id = request()->route('id');

        if($id) {
            $class = $this->classes->getClassById($id);

            if(!$class) {
                $result = ['error' => 'Class not found.'];
            } else {
                $result = $class;
            }
        } else {
            $classes = $this->classes->getAllClasses();
            $result = $classes;
        }

        return response()->json($result);
    }

    public function apiSchedules() {
        $result = array();
        $venues = $this->venues->getAllVenues();

        foreach($venues as $venue) {
            $schedules = $this->classOptions->getSchedulesByVenueId($venue['id']);
            
            if(!empty($schedules)) {
                foreach($schedules as $key => $schedule) {
                    $result[$venue['name']][] = [
                        'event' => $this->classes->getClassById($schedule['class_id'])['name'],
                        'starts' => $schedule['start_time'],
                        'ends' => $schedule['end_time'],
                        'frequency' => $schedule['frequency'],
                        'day' => $schedule['day'],
                    ];
                }
            }
        }

        uasort($result, function($a, $b) {
            return strcmp($a[0]['day'], $b[0]['day']);
        });

        return response()->json($result);
    }

    public function apiCreateOptions(AdminClassOptionRequest $request) {
        $json = array();
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->classOptions->createClassOption($data);

        if (isset($result['error'])) {
            $json['error'] = $result['error'];
        }

        $json['success'] = 'Class option created successfully!';

        return response()->json($json);
    }

    public function apiOption() {
        $result = array();
        $id = request()->route('id');

        if($id) {
            $option = $this->classOptions->getOptionById($id);

            if(!$option) {
                $result = ['error' => 'Class option not found.'];
            } else {
                $result = $option;
            }
        } else {
            $result = ['error' => 'Option ID is required.'];
        }

        return response()->json($result);
    }

    public function apiUpdateOptions(AdminClassOptionRequest $request, string $id) {
        $json = array();
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->classOptions->updateClassOption($id, $data);

        if (isset($result['error'])) {
            $json['error'] = $result['error'];
        }

        $json['success'] = 'Class option updated successfully!';

        return response()->json($json);
    }
}

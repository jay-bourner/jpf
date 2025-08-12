<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;
use Illuminate\Support\Str;
use App\Models\ClassOptions;
use Carbon\Carbon;

class Classes extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'venue_id',
        'name',
        'short_description',
        'description',
        'image',
        'image_description',
        'status',
        'start_date',
        'notes',
    ];

    protected $imageService;
    protected $category;
    protected $classOptions;

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->imageService = app(ImageService::class);
        $this->category = app(Categories::class);
        $this->classOptions = app(ClassOptions::class);
    }

    public function getAllClasses()
    {
        $result = array();

        $classes = $this->all();

        foreach($classes as $class) {
            if($class->image) {
                $imageString = $class->image;
                $imageString = str_replace('image/', '', $imageString);
            } else {
                $imageString = 'icons/no_image.png';
            }

            $url = 'classes/' . Str::slug($class->name);

            $category = $this->category->getCategoryById($class->category_id);
            $filter = $category['filter'];

            $result[] = [
                'id' => $class->id,
                'name' => $class->name,
                'category_id' => $class->category_id,
                'category' => $category['name'],
                'name' => $class->name,
                'filter' => $filter,
                'short_description' => html_entity_decode($class->short_description ?? ''),
                'url' => $url,
                'description' => html_entity_decode($class->description ?? ''),
                'notes' => html_entity_decode($class->notes ?? ''),
                'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
                'image_description' => html_entity_decode($class->image_description ?? ''),
                'start_date' => $class->start_date,
                'status' => $class->status,
            ];
        }

        return $result;
    }


    public function getClassesByCategory($categoryId)
    {
        $classes = $this->where('category_id', $categoryId)->get();
        // This method can be implemented to retrieve classes by category if needed
        return $classes;
    }

    public function getClassesByName($name)
    {
        $result = array();

        $name = str_replace('-', ' ', $name);

        $class = $this->where('name', 'like', '%' . $name . '%')->get();

        if(!$class || $class->isEmpty()) {
            $result = [
                'error' => 'Class not found.'
            ];
        }

        if(!isset($result['error'])) {
            foreach($class as $cl) {
                if($cl->image) {
                    $no_image = false;
                    $imageString = $cl->image;
                    $imageString = str_replace('image/', '', $imageString);
                } else {
                    $no_image = true;
                    $imageString = 'icons/no_image.png';
                }
    
                $url = 'classes/' . Str::slug($cl->name);
    
                $category = $this->category->getCategoryById($cl->category_id);
                $filter = $category['filter'];
    
                $result = array(
                    'id' => $cl->id,
                    'name' => $cl->name,
                    'category_id' => $cl->category_id,
                    'category' => $category['name'],
                    'filter' => $filter,
                    'short_description' => html_entity_decode($cl->short_description ?? ''),
                    'url' => $url,
                    'description' => html_entity_decode($cl->description ?? ''),
                    'notes' => html_entity_decode($cl->notes ?? ''),
                    'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
                    'image_description' => html_entity_decode($cl->image_description ?? ''),
                    'no_image' => $no_image,
                    'start_date' => $cl->start_date,
                    'status' => $cl->status,
                    'options' => $this->classOptions->getClassOptions($cl->id),
                );
            }
        }
        
        return $result;
    }

    public function getClassById($id)
    {
        $class = $this->where('id', $id)->first();

        if (!$class) {
            return null;
        }

        if($class->image) {
            $imageString = $class->image;
            $imageString = str_replace('image/', '', $imageString);
        } else {
            $imageString = 'icons/no_image.png';
        }

        $url = 'classes/' . Str::slug($class->name);

        $category = $this->category->getCategoryById($class->category_id);
        $filter = $category['filter'];

        return array(
            'id' => $class->id,
            'name' => $class->name,
            'category_id' => $class->category_id,
            'category' => $category['name'],
            'filter' => $filter,
            'short_description' => html_entity_decode($class->short_description ?? ''),
            'url' => $url,
            'description' => html_entity_decode($class->description ?? ''),
            'notes' => html_entity_decode($class->notes ?? ''),
            'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
            'image_description' => html_entity_decode($class->image_description ?? ''),
            'start_date' => $class->start_date,
            'status' => $class->status,
            'options' => $this->classOptions->getClassOptions($class->id),
        );
    }

    public function createClass($data)
    {
        $result = array();

        try {
            $class = new self();
            $class->category_id = (int)$data['category_id'];
            $class->venue_id = (int)$data['venue_id'];
            $class->name = $data['name'];
            $class->short_description = htmlspecialchars($data['short_description']);
            $class->description = htmlspecialchars($data['description'] ?? null);
            $class->image = htmlspecialchars($data['image'] ?? null);
            $class->image_description = htmlspecialchars($data['image_description'] ?? null);
            $class->status = ($data['start_date'] && $data['start_date'] > Carbon::now()) ? 'inactive' : 'active';
            $class->start_date = $data['start_date'] ?? Carbon::now();
            // $class->notes = htmlspecialchars($data['notes']) ?? null;

            if($class->save()) {
                $result = ['success' => 'Class added successfully.', 'class' => $class];
            } 
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to add class. ' . $e->getMessage()];
        }

        return $result;
    }

    public function updateClass($id, $data)
    {
        $result = array();

        try {
            $class = $this->find($id);
            $class->category_id = (int)$data['category_id'];
            $class->venue_id = (int)$data['venue_id'];
            $class->name = $data['name'];
            $class->short_description = htmlspecialchars($data['short_description']);
            $class->description = htmlspecialchars($data['description'] ?? null);
            $class->image = htmlspecialchars($data['image'] ?? null);
            $class->image_description = htmlspecialchars($data['image_description'] ?? null);
            $class->status = ($data['start_date'] && $data['start_date'] > Carbon::now()) ? 'inactive' : 'active';
            $class->start_date = $data['start_date'] ?? Carbon::now();
            // $class->notes = htmlspecialchars($data['notes']) ?? null;

            // dd($class);
            if($class->update()) {
                $result = ['success' => 'Class added successfully.', 'class' => $class];
            } 
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to add class. ' . $e->getMessage()];
        }

        return $result;
    }

    public function deleteClass($id)
    {
        $result = array();

        try {
            $class = $this->find($id);
            $classOptions = $this->classOptions->where('class_id', $id)->get();
            if ($classOptions) {
                foreach ($classOptions as $option) {
                    $option->delete();
                }
            }
            
            if ($class) {
                $class->delete();
                $result = ['success' => 'Class deleted successfully.'];
            } else {
                $result = ['warning' => 'Class not found.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to delete class. ' . $e->getMessage()];
        }

        return $result;
    }
}

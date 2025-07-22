<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;
use Illuminate\Support\Str;
use App\Models\ClassOptions;

class Classes extends Model
{
    use HasFactory;
    
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
                'title' => $class->title ?? '',
                'short_description' => $class->short_description ?? '',
                'url' => $url,
                'description' => $class->description,
                'notes' => $class->notes,
                'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
                'image_description' => $class->image_description ?? '',
                'start_date' => $class->created_at,
                'status' => $class->updated_at,
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
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);

        $class = $this->where('name', 'like', '%' . $name . '%')->get();

        foreach($class as $cl) {
            if($cl->image) {
                $imageString = $cl->image;
                $imageString = str_replace('image/', '', $imageString);
            } else {
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
                // 'title' => $cl->title ?? '',
                'short_description' => $cl->short_description ?? '',
                'url' => $url,
                'description' => $cl->description,
                'notes' => $cl->notes,
                'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
                'image_description' => $cl->image_description ?? '',
                'start_date' => $cl->created_at,
                'status' => $cl->updated_at,
                'options' => $this->classOptions->getClassOptions($cl->id),
            );
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
            'title' => $class->title ?? '',
            'short_description' => $class->short_description ?? '',
            'url' => $url,
            'description' => $class->description,
            'notes' => $class->notes,
            'image' => ($imageString) ? $this->imageService->resize($imageString, 400, 400) : null,
            'image_description' => $class->image_description ?? '',
            'start_date' => $class->created_at,
            'status' => $class->updated_at,
            'options' => $this->classOptions->getClassOptions($class->id),
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Classes extends Model
{
    use HasFactory;
    
    protected $imageService;
    protected $category;

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->imageService = app(ImageService::class);
        $this->category = app(Categories::class);
    }

    public function getAllClasses()
    {
        $result = array();

        $classes = $this->all();

        foreach($classes as $class) {
            $imageString = $class->image;
            $imageString = str_replace('image/', '', $imageString);
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
                'url' => $class->url ?? '',
                'description' => $class->description,
                'notes' => $class->notes,
                'image' => ($imageString) ? $this->imageService->resize($imageString, 300, 300) : null,
                'image_description' => $class->image_description ?? '',
                'start_date' => $class->created_at,
                'status' => $class->updated_at,
            ];
        }

        // This method can be implemented to retrieve all classes if needed
        return $result;
    }


    public function getClassesByCategory($categoryId)
    {
        $classes = $this->where('category_id', $categoryId)->get();
        // This method can be implemented to retrieve classes by category if needed
        return $classes;
    }
}

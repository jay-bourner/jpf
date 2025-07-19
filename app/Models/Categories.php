<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Categories extends Model
{
    use HasFactory;

    protected $imageService;

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->imageService = app(ImageService::class);
    }

    public function getAllCategories()
    {
        $result = array();

        $categories = $this->all();

        foreach ($categories as $category) {
            $imageString = $category->image;
            $imageString = str_replace('image/', '', $imageString);

            $result[] = [
                'id' => $category->id,
                'name' => $category->name,
                'filter' => strtolower(str_replace(' ', '-', $category->name)),
                'image' => $this->imageService->resize($imageString, 300, 300),
                'alt' => ($category->description) ? $category->description : $category->name . ' Category',
            ];
        }

        return $result;
    }

    public function getCategoryById($id)
    {
        $category = $this->find($id);
        
        $imageString = $category->image;
        $imageString = str_replace('image/', '', $imageString);
        
        if ($category) {
            return  [
                'id' => $category->id,
                'name' => $category->name,
                'filter' => strtolower(str_replace(' ', '-', $category->name)),
                'image' => $this->imageService->resize($imageString, 300, 300),
                'alt' => ($category->description) ? $category->description : $category->name . ' Category',
            ];
        }
        return null;
    }
}

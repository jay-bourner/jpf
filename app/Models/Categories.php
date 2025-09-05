<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        // 'short_description',
        // 'image_description',
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
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
                'image' => $category->image,
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
                'image' => $category->image,
                'short_description' => ($category->short_description) ? $category->short_description : '',
                'image_description' => ($category->image_description) ? $category->image_description : $category->name . ' Category',
            ];
        }
        return null;
    }

    public function createCategory($data)
    {
        $result = array();

        try {
            $category = new self();
            $category->name = $data['name'];
            $category->image = $data['image'] ?? null;
            $category->short_description = $data['short_description'] ?? null;
            $category->image_description = $data['image_description'] ?? null;
            
            if($category->save()) {
                $result = ['success' => 'Category added successfully.', 'category' => $category];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'failed to create category'.$e->getMessage()];
        }

        return $result;
    }

    public function updateCategory($id, $data)
    {
        $result = array();

        try {
            $category = $this->find($id);

            if ($category) {
                $category->name = $data['name'];
                $category->short_description = $data['short_description'];
                $category->image = $data['image'] ?? $category->image;
                $category->image_description = $data['image_description'];
                
                if ($category->update()) {
                    $result = ['success' => 'Category updated successfully.', 'category' => $category];
                }
            } else {
                $result = ['warning' => 'Category not found.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to update category: ' . $e->getMessage()];
        }

        return $result;
    }

    public function deleteCategory($id)
    {
        $result = array();

        try {
            $category = $this->find($id);

            if (!$category) {
                return ['warning' => 'Category not found.'];
            }

            if ($category->delete()) {
                $result = ['success' => 'Category deleted successfully.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to delete category. ' . $e->getMessage()];
        }

        return $result;
    }
}

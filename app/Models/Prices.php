<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    use HasFactory;

    protected $table = 'class_prices';
    
    public $timestamps = false;

    protected $fillable = [
        'price',
        'type',
        'classes',
        'period',
        'notes',
    ];

    public function getAllPrices() {
        $result = array();

        $prices = $this->all();

        foreach($prices as $price) {
            $result[] = [
                'id' => $price->id,
                'price' => '£'.$price->price,
                'type' => $price->type,
                'classes' => $price->classes,
                'period' => $price->period,
                'notes' => $price->notes,
            ];
        }

        return $result;
    }

    public function getPriceById($id)
    {
        $price = $this->where('id', $id)->first();

        if (!$price) {
            return null;
        }

        return array(
            'id' => $price->id,
            'price' => $price->price,
            'type' => $price->type,
            'classes' => $price->classes,
            'period' => $price->period,
            'notes' => $price->notes,
        );
    }

    public function createPrice($data)
    {
        $result = array();

        try {
            $price = new self();
            $price->price = $data['price'];
            $price->type = $data['type'];
            $price->classes = $data['classes'];
            $price->period = $data['period'];
            $price->notes = $data['notes'];

            if($price->save()) {
                $result = ['success' => 'Price created successfully.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to create price. '  . $e->getMessage()];
        }

        return $result;
    }

    public function updatePrice($id, $data)
    {
        $result = array();

        try {
            $price = $this->find($id);
            if (!$price) {
                return ['warning' => 'Price not found.'];
            }

            $price->price = $data['price'];
            $price->type = $data['type'];
            $price->classes = $data['classes'] ?? null;
            $price->period = $data['period'] ?? null;
            $price->notes = $data['notes'] ?? null;

            $price->update($data);

            $result = ['success' => 'Price updated successfully.'];
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to update price. ' . $e->getMessage()];
        }

        return $result;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    use HasFactory;

    protected $table = 'class_prices';

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    use HasFactory;

    public function getAllVenues()
    {
        $result = array();

        $venues = $this->all();

        foreach($venues as $venue) {
            $result[] = [
                'id' => $venue->id,
                'name' => $venue->name,
                'address' => $venue->address,
                'town' => $venue->town,
                'postcode' => $venue->postcode,
                'capacity' => $venue->capacity,
            ];
        }

        return $result;
    }

    public function getVenuesById($id)
    {
        $venue = $this->find($id);

        if (!$venue) {
            return null;
        }

        return array(
            'id' => $venue->id,
            'name' => $venue->name,
            'address' => $venue->address,
            'town' => $venue->town,
            'postcode' => $venue->postcode,
            'capacity' => $venue->capacity,
        );
    }
}

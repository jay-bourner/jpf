<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'town',
        'postcode',
        'capacity',
    ];

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

    public function getVenuesByName($name)
    {
        $result = array();

        $name = str_replace('-', ' ', $name);

        $venue = $this->where('name', 'like', '%' . $name . '%')->get();

        if(!$venue || $venue->isEmpty()) {
            $result = [
                'error' => 'Venue not found.'
            ];
        }

        if(!isset($result['error'])) {
            $result = array(
                'id' => $venue->id,
                'name' => $venue->name,
                'address' => $venue->address,
                'town' => $venue->town,
                'postcode' => $venue->postcode,
                'capacity' => $venue->capacity,
            );
        }

        return $result;
    }

    public function createVenue($data)
    {
        $result = array();
        
        try {
            $venue = new self();
            $venue->name = $data['name'];
            $venue->address = $data['address'];
            $venue->town = $data['town'];
            $venue->postcode = $data['postcode'];
            $venue->capacity = $data['capacity'] ?? null;

            if($venue->save()) {
                $result = ['success' => 'Venue added successfully.', 'venue' => $venue];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to add venue. ' . $e->getMessage()];
        }

        return $result;
    }

    public function updateVenue($id, $data)
    {
        $result = array();

        try {
            $venue = $this->find($id);
            if (!$venue) {
                return ['warning' => 'Venue not found.'];
            }

            $venue->name = $data['name'];
            $venue->address = $data['address'];
            $venue->town = $data['town'];
            $venue->postcode = $data['postcode'];
            $venue->capacity = $data['capacity'] ?? null;

            if ($venue->save()) {
                $result = ['success' => 'Venue updated successfully.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to update venue. ' . $e->getMessage()];
        }

        return $result;
    }

    public function deleteVenue($id)
    {
        $result = array();

        try {
            $venue = $this->find($id);
            if (!$venue) {
                return ['warning' => 'Venue not found.'];
            }

            if ($venue->delete()) {
                $result = ['success' => 'Venue deleted successfully.'];
            }
        } catch (\Exception $e) {
            $result = ['warning' => 'Failed to delete venue. ' . $e->getMessage()];
        }

        return $result;
    }
}
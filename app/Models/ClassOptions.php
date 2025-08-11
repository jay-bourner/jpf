<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassOptions extends Model
{
    use HasFactory;

    protected $table = 'class_options';
    
    public $timestamps = false;

    protected $fillable = [
        'class_id',
        'venue_id',
        'start_time',
        'end_time',
        'frequency',
        'day',
    ];

    protected $venues;

    public function __construct($attributes = array()) {
        parent::__construct($attributes);

        $this->venues = app(Venues::class);
    }

    public function getClassOptions($id)
    {
        $options = $this->where('class_id', $id)->get();
        $results = [];
        foreach ($options as $option) {
            $venue = $this->venues->getVenuesById($option->venue_id);

            $results[] = [
                'id' => $option->id,
                'class_id' => $option->class_id,
                'venue_id' => $option->venue_id,
                'venue' => $venue['name'],
                'venue_url' => $this->getGoogleApiLocation($venue),
                'start_time' => $option->start_time,
                'end_time' => $option->end_time,
                'frequency' => $option->frequency,
                'day' => $option->day,
            ];
        }

        return $results;
    }
    
    private function getGoogleApiLocation($venue)
    {
        $address = urlencode($venue['address'] . ' ' . $venue['town'] . ' ' . $venue['postcode']);
        
        $url = "https://www.google.com/maps/place/{$address}";

        return $url;
    }
}

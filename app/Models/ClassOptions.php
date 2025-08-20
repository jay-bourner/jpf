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

    public function createClassOption($data)
    {
        $option = new self();
        $option->class_id = $data['class_id'];
        $option->venue_id = $data['venue_id'];
        $option->start_time = $data['start_time'];
        $option->end_time = $data['end_time'];
        $option->frequency = $data['frequency'];
        $option->day = $data['day'];

        if ($option->save()) {
            return ['success' => 'Class option created successfully!'];
        }

        return ['error' => 'Failed to create class option.'];
    }
    // {
    //     $options = $this->where('venue_id', $venue_id)->get();
    //     $results = [];
    //     foreach ($options as $option) {
    //         $results[] = [
    //             'id' => $option->id,
    //             'class_id' => $option->class_id,
    //             'venue_id' => $option->venue_id,
    //             'start_time' => $option->start_time,
    //             'end_time' => $option->end_time,
    //             'frequency' => $option->frequency,
    //             'day' => $option->day,
    //         ];
    //     }

    //     return $results;
    // }
    
    private function getGoogleApiLocation($venue)
    {
        $address = urlencode($venue['address'] . ' ' . $venue['town'] . ' ' . $venue['postcode']);
        
        $url = "https://www.google.com/maps/place/{$address}";

        return $url;
    }

    public function getSchedulesByVenueId($venue_id)
    {
        $schedules = $this->where('venue_id', $venue_id)->get();
        $results = [];
        foreach ($schedules as $schedule) {
            $results[] = [
                'id' => $schedule->id,
                'class_id' => $schedule->class_id,
                'venue_id' => $schedule->venue_id,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,
                'frequency' => $schedule->frequency,
                'day' => $schedule->day,
            ];
        }

        return $results;
    }
}

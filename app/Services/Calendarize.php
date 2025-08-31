<?php

namespace App\Services;

class Calendarize
{
    public function makeSchedule($classOptions)
    {
        $schedule = [];

        foreach ($classOptions as $option) {
            $schedule[] = [
                'day' => $option['day'],
                'start_time' => $option['start_time'],
                'end_time' => $option['end_time'],
                'frequency' => $option['frequency'],
                'venue' => $option['venue'],
                'venue_url' => $option['venue_url'],
            ];
        }

        return $schedule;
    }
}
<?php

namespace App\Services;

use Carbon\Carbon;
use DateTime;

class ScheduleService
{
    /**
     * Make a schedule for a class based on options frequency, day and start/end time.
     * 
     */
    public function makeSchedule($start_date, $classOptions, $limit = 4)
    {
        $schedule = array();

        // start date of the class
        $beginning = new DateTime($start_date);
        $today_date = new DateTime();

        $beginningDate = '';
        $beginningDay = '';

        //get the starting date and day of the class
        if($beginning > $today_date) {
            $beginningDate = clone $beginning;
        } else {
            $beginningDate = clone $today_date;
        }
        $beginningDay = $beginningDate->format('l');

        foreach($classOptions as $option) {
            $dayOfWeek = $option['day'];        // e.g., 'Monday'
            $startTime = $option['start_time']; // e.g., '10:00:00'
            $endTime = $option['end_time'];     // e.g., '11:00:00'
            $frequency = $option['frequency'];  // e.g., 'weekly', 'bi-weekly', 'monthly'

            if($dayOfWeek === $beginningDay) {
                // If the class day is today, schedule it for today
                $nextDate = clone $beginningDate;
            } else {
                // Otherwise, find the next occurrence of the class day
                $nextDate = $this->getNextDate($beginningDate->format('Y-m-d'), $dayOfWeek);
            }

            // create first instance of schedule
            $schedule[$option['venue']][] = [
                'date' => Carbon::parse($nextDate)->format('F j, Y') . " (". $nextDate->format('l') .")",
                'time' => Carbon::parse($startTime)->format('g:i A') . " - " . Carbon::parse($endTime)->format('g:i A')
            ];

            // Generate subsequent dates based on frequency and $limit variable passed into function
            for ($i = 0; $i < $limit; $i++) {
                $date = $nextDate;

                switch ($frequency) {
                    case 'weekly':
                        $date->modify('+1 week');
                        break;
                    case 'bi-weekly':
                        $date->modify('+2 weeks');
                        break;
                    case 'monthly':
                        $date->modify('+1 month');
                        break;
                    // case 'custom':
                    //     // For custom frequency, let's assume it's every 10 days for this example
                    //     $date->modify('+10 days');
                    //     break;
                    default:
                        // If frequency is unknown, default to weekly
                        $date->modify('+1 week');
                        break;
                }
                
                $schedule[$option['venue']][] = [
                    'date' => Carbon::parse($date)->format('F j, Y') . " (". $date->format('l') .")",
                    'time' => Carbon::parse($startTime)->format('g:i A') . " - " . Carbon::parse($endTime)->format('g:i A')
                ];
            }
        }

        return $schedule;
    }

    function getNextDate($start, $dayOfWeek) {
        $date = new DateTime($start);
        $date->modify('next ' . $dayOfWeek);
        return $date;
    }
}
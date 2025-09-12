<?php

namespace App\Services;

use DateTime;

class schema
{
    public function build($array) {
        $schema = '<script type="application/ld+json">';
        $schema .= json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                ...$array
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $schema .= '</script>';

        return $schema;
    }
    
    public function createAddressSchema($options) {
        $openingHoursSpecification = array();

        foreach($options as $option) {
            $openingHoursSpecification[] = [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => $option['day'],
                'opens' => (new DateTime($option['start_time']))->format('H:i'),
                'closes' => (new DateTime($option['end_time']))->format('H:i'),
            ];
        }

        return $openingHoursSpecification;
    }
}
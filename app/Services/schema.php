<?php

namespace App\Services;

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
}



// {
//     "@context": "http://schema.org",
//     "@graph": {
//         "@type": "@Organization",
//         "url": "https://www.nakedkitchens.com",
//         "name": "Naked Kitchens",
//         "description": "Bespoke kitchens that are as unique as you are, built to handle all the beautiful chaos that real life throws at them.",
//         "publisher": {
//             "@id": "https://www.nakedkitchens.com#Organization"
//         },
//         "inLanguage": "English",
//         "isPartOf": {
//             "@id": "https://www.nakedkitchens.com"
//         },
//         "about": {
//             "@id": "https://www.nakedkitchens.com#Organization"
//         },
//         "@id": "https://www.nakedkitchens.com#Organization",
//         "logo": "https://www.nakedkitchens.com/image/catalog/logos/naked-kitchens/naked-favicon.png",
//         "contactPoint": [
//             {
//                 "@type": "ContactPoint",
//                 "telephone": "(+44)1328 838 854",
//                 "email": "info@nakedkitchens.com",
//                 "contactType": "customer service",
//                 "availableLanguage": "English",
//                 "uri": "https://www.nakedkitchens.com/showrooms/norfolk",
//                 "address": {
//                     "@type": "PostalAddress",
//                     "streetAddress": "Hangar 4",
//                     "addressLocality": "West Raynham Business Park",
//                     "addressRegion": "Fakenham",
//                     "postalCode": "NR21 7PL"
//                 }
//             },
//             {
//                 "@type": "ContactPoint",
//                 "telephone": "(+44)1328 838 854",
//                 "email": "info@nakedkitchens.com",
//                 "contactType": "customer service",
//                 "availableLanguage": "English",
//                 "uri": "https://www.nakedkitchens.com/showrooms/bloomsbury",
//                 "address": {
//                     "@type": "PostalAddress",
//                     "streetAddress": "10 Bloomsbury Way",
//                     "addressRegion": "London",
//                     "postalCode": "WC1A 2SL"
//                 }
//             },
//             {
//                 "@type": "ContactPoint",
//                 "telephone": "(+44)1328 838 854",
//                 "email": "info@nakedkitchens.com",
//                 "contactType": "customer service",
//                 "availableLanguage": "English",
//                 "uri": "https://www.nakedkitchens.com/showrooms/chelsea-kitchens",
//                 "address": {
//                     "@type": "PostalAddress",
//                     "streetAddress": "120 Fulham Rd",
//                     "addressLocality": "South Kensington",
//                     "addressRegion": "London",
//                     "postalCode": "SW3 6HU"
//                 }
//             }
//         ],
//         "address": {
//             "@type": "PostalAddress",
//             "streetAddress": "Hangar 4, Blenheim Way",
//             "addressLocality": "Fakenham",
//             "addressRegion": "Norfolk",
//             "postalCode": "NR21 7PL",
//             "addressCountry": "UK"
//         },
//         "SameAs": [
//             "https://www.instagram.com/nakedkitchens/",
//             "https://www.facebook.com/NAKEDkitchens",
//             "https://uk.pinterest.com/nakedkitchens/",
//             "https://www.youtube.com/@Nakedkitchens"
//         ],
//         "founders": [
//             {
//                 "@type": "Person",
//                 "name": "Jamie Everett",
//                 "sameAs": "https://www.linkedin.com/in/james-everett-858870236/?originalSubdomain=uk"
//             },
//             {
//                 "@type": "Person",
//                 "name": "Jayne Everett"
//             }
//         ],
//         "hasOfferCatalog": {
//             "@type": "OfferCatalog",
//             "name": "Naked Kitchens Catalog",
//             "sameAs": "https://www.wikidata.org/wiki/Q43164"
//         }
//     }
// }
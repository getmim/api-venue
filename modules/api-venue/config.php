<?php

return [
    '__name' => 'api-venue',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-venue.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-venue' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'venue' => NULL
            ],
            [
                'lib-app' => NULL
            ],
            [
                'api' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiVenue\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-venue/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiVenueIndex' => [
                'path' => [
                    'value' => '/venue/object'
                ],
                'handler' => 'ApiVenue\\Controller\\Venue::index',
                'method' => 'GET'
            ],
            'apiVenueSingle' => [
                'path' => [
                    'value' => '/venue/object/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'handler' => 'ApiVenue\\Controller\\Venue::single',
                'method' => 'GET'
            ]
        ]
    ]
];
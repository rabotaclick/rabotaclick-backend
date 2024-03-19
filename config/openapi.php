<?php

return [

    'collections' => [

        'default' => [

            'info' => [
                'title' => config('app.name'),
                'description' => null,
                'version' => '1.0.0',
                'contact' => [],
            ],

            'servers' => [
                [
                    'url' => env('APP_URL'),
                    'description' => null,
                    'variables' => [],
                ],
            ],

            'tags' => [

                [
                    'name' => 'Applicant',
                    'description' => 'Исполнитель',
                ],
                [
                    'name' => 'Employer',
                    'description' => 'Работодатель'
                ],
                [
                    'name' => 'Company',
                    'description' => 'Компания'
                ],
                [
                    'name' => 'User',
                    'description' => 'Пользователь'
                ],
                [
                    'name' => 'UserEmployer',
                    'description' => 'Пользователь работодателя'
                ],
                [
                    'name' => 'Specialization',
                    'description' => 'Категории вакансий'
                ],
                [
                    'name' => 'Resume',
                    'description' => 'Резюме'
                ],
                [
                    'name' => 'Vacancy',
                    'description' => 'Вакансия'
                ],
                [
                    'name' => 'City',
                    'description' => 'Города'
                ],
                [
                    'name' => 'Storage',
                    'description' => 'Выгрузка файлов в хранилище'
                ],
                [
                    'name' => 'Country',
                    'description' => 'Страны'
                ],
                [
                    'name' => 'KeySkill',
                    'description' => 'Ключевые Навыки'
                ],
                [
                    'name' => 'Language',
                    'description' => 'Язык'
                ],
                [
                    'name' => 'Region',
                    'description' => 'Регион'
                ]

            ],

            'security' => [
                 //GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement::create()->securityScheme('BearerToken'),
            ],

            // Non standard attributes used by code/doc generation tools can be added here
            'extensions' => [
                // 'x-tagGroups' => [
                //     [
                //         'name' => 'General',
                //         'tags' => [
                //             'user',
                //         ],
                //     ],
                // ],
            ],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [
                'uri' => '/openapi',
                'middleware' => [],
            ],

            // Register custom middlewares for different objects.
            'middlewares' => [
                'paths' => [
                    //
                ],
                'components' => [
                    //
                ],
            ],

        ],

    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations' => [
        'callbacks' => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies' => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses' => [
            app_path('OpenApi/Responses'),
        ],

        'schemas' => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],

];

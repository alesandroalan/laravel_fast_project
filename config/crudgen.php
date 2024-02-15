<?php

return
[
	'views_style_directory'=> 'adminlte-theme',
	'separate_style_according_to_actions' =>
    [
        'index'=>
        [
            'extends'=>'adminlte::page',
            'section'=>'content'
        ],
        'create'=>
        [
            'extends'=>'adminlte::page',
            'section'=>'content'
        ],
        'edit'=>
        [
            'extends'=>'adminlte::page',
            'section'=>'content'
        ],
        'show'=>
        [
            'extends'=>'adminlte::page',
            'section'=>'content'
        ],
    ],
    'paths' =>
    [
        'service' =>
        [
            'path' => app_path('Services'),
            'namespace' => 'App\Services'
        ]
    ]

];

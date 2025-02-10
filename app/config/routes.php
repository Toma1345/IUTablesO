<?php
return [
    '/' => [
        'controler' => IUT\controlers\Homecontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ],
    '/detail' => [
        'controler' => IUT\controlers\Detailcontroler::class,
        'methods' => ['GET'],
        'redirect' => '/',
        'requiresArgument' => true
    ],
    '/login' => [
        'controler' => IUT\controlers\Logincontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ],
    '/search' => [
        'controler' => IUT\controlers\Searchcontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ],
    '/logout' => [
        'controler' => IUT\controlers\Logoutcontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ],
    '/me' => [
        'controler' => IUT\controlers\Profilecontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ],
    '/suscribe' => [
        'controler' => IUT\controlers\Suscribecontroler::class,
        'methods' => ['GET', 'POST'],
        'redirect' => '/',
        'requiresArgument' => false
    ]
];

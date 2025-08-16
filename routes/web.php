<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ContactController;
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;


$router->get('/', function() use ($container) {
    $container->call([HomeController::class, 'index']);
});

$router->get('/contact', function() use ($container) {
    $container->call([ContactController::class, 'show']);
});

$router->post('/contact', function() use ($container) {
    $container->call([ContactController::class, 'store']);
});


$router->mount('/api', function () use ($router, $container) {

    $router->post('/login', function() use ($container) {
        $container->call([AuthController::class, 'login']);
    });

    $router->before('GET', '/profile', fn() => (new AuthMiddleware())->handle());
    $router->get('/profile', function() use ($container) {
        $container->call([AuthController::class, 'profile']);
    });
    
});

$router->before('POST|PUT|DELETE|PATCH', '/.*', function() {
    (new CsrfMiddleware())->handle();
});
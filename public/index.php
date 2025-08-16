<?php

use App\Core\Session;
use App\Middleware\CsrfMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$whoops = new \Whoops\Run;

if ($_ENV['APP_ENV'] === 'development') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    $whoops->pushHandler(function ($exception, $inspector, $run) {
        $log = new \Monolog\Logger('PicoFrame');
        $log->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__ . '/../storage/logs/app.log', \Monolog\Logger::ERROR));
        
        $log->error($exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);

        http_response_code(500);
        require __DIR__ . '/../app/Views/errors/500.php';
    });
    $whoops->register();
}

Session::start();
CsrfMiddleware::generateToken();

$container = require __DIR__ . '/../config/container.php';


$routeCacheFile = __DIR__ . '/../storage/cache/routes.cache';

if ($_ENV['APP_ENV'] === 'production' && file_exists($routeCacheFile)) {
    $router = unserialize(file_get_contents($routeCacheFile));

} else {
    
    $router = new \Bramus\Router\Router();
    require_once __DIR__ . '/../routes/web.php';
}

$router->run();
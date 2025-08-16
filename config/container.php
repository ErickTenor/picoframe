<?php

use DI\ContainerBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Middleware\CsrfMiddleware;
use Twig\TwigFunction;
use App\Core\Vite;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([

    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../app/Views');
        $twig = new Environment($loader, [
            // 'cache' => __DIR__ . '/../storage/cache',
        ]);
        $twig->addGlobal('vite', new Vite());

        $csrfFunction = new TwigFunction('csrf_field', function () {
            $token = CsrfMiddleware::getToken();
            return '<input type="hidden" name="_csrf_token" value="' . $token . '">';
        }, ['is_safe' => ['html']]);
        $twig->addFunction($csrfFunction);

        return $twig;
    },
]);

return $containerBuilder->build();
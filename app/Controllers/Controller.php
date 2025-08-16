<?php

namespace App\Controllers;

use Twig\Environment;

class Controller
{
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    protected function render($view, $data = [])
    {
        echo $this->twig->render($view, $data);
    }

    public function jsonResponse($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }
}
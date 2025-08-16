<?php

namespace App\Middleware;

use App\Core\Session;

class CsrfMiddleware
{
    public function handle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $submittedToken = $_POST['_csrf_token'] ?? null;
        $sessionToken = Session::get('_csrf_token');

        if (!$submittedToken || !$sessionToken || !hash_equals($sessionToken, $submittedToken)) {
            http_response_code(419);
            die('Error de validación CSRF: Token inválido.');
        }
    }

    public static function generateToken()
    {
        if (!Session::has('_csrf_token')) {
            $token = bin2hex(random_bytes(32));
            Session::set('_csrf_token', $token);
        }
    }

    public static function getToken()
    {
        return Session::get('_csrf_token');
    }
}
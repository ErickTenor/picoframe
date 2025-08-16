<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    public function handle()
    {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $this->unauthorized('Token no proporcionado o malformado.');
        }

        $token = $matches[1];
        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
        } catch (\Exception $e) {
            $this->unauthorized('Acceso denegado: Token inválido.');
        }
    }

    protected function unauthorized($message)
    {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode(['error' => $message]);
        exit();
    }
}
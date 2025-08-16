<?php

namespace App\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Rakit\Validation\Validator;

class AuthController extends Controller
{

    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true) ?? [];
    
    $validator = new Validator;
    $validation = $validator->make($input, [
        'email'    => 'required|email',
        'password' => 'required|min:8'
    ]);

    $validation->validate();

    if ($validation->fails()) {
        $errors = $validation->errors();
        return $this->jsonResponse(['errors' => $errors->firstOfAll()], 422);
    }

    $user = User::where('email', $input['email'])->first();

    if (!$user || !password_verify($input['password'], $user->password)) {
        return $this->jsonResponse(['error' => 'Credenciales inválidas'], 401);
    }

    $payload = [
        'iat' => time(),
        'exp' => time() + (60 * 60),
        'data' => ['id' => $user->id, 'email' => $user->email]
    ];

    $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
    return $this->jsonResponse(['message' => 'Login exitoso', 'token' => $token]);
    }

    public function profile()
    {
        return $this->jsonResponse(['message' => 'Acceso a perfil protegido concedido.']);
    }
}
<?php

namespace Database\Seeders;
    
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseSeeder
{
    public function run()
    {

        Capsule::statement('SET FOREIGN_KEY_CHECKS=0;');

        Post::truncate();
        User::truncate();

        Capsule::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => "Usuario {$i}",
                'email' => "user{$i}@example.com",
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ]);

            for ($j = 0; $j < 5; $j++) {
                Post::create([
                    'user_id' => $user->id,
                    'title' => "Post {$j} de {$user->name}",
                    'body' => 'Este es el contenido del post.'
                ]);
            }
        }
    }
}
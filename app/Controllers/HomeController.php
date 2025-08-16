<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        
        $data = ['title' => '¡Bienvenido a PicoFrame con Twig!'];

        
        $this->render('home.twig', $data);
    }

}
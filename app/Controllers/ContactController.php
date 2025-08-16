<?php

namespace App\Controllers;

class ContactController extends Controller
{
    
    public function show()
    {
        $this->render('contact.twig');
    }

    
    public function store()
    {
        
        $this->render('contact_success.twig');
    }
}
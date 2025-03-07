<?php

namespace App\Controllers;

class ContactController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/contact/contact.view.php'; // Chemin vers ta page HTML
        exit(); // Empêche l'exécution de code supplémentaire
    }
}

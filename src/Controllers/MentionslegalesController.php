<?php

namespace App\Controllers;

class MentionslegalesController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/mention/mentionlegales.view.php'; // Chemin vers ta page HTML
        exit(); // Empêche l'exécution de code supplémentaire
    }
}

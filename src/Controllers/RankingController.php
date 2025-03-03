<?php

namespace App\Controllers;

class RankingController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/ufc/ranking.view.php'; // Chemin vers ta page HTML
        exit(); // Empêche l'exécution de code supplémentaire
    }
}

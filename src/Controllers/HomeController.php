<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Article;

class HomeController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            $article = new Article(null, null, null, null, null, null); // Constructeur avec des valeurs par défaut
            $arrayArticles = $article->getAllArticles(); // Méthode à définir dans le modèle Article

            if ($_SESSION['user']['idRole'] == 1) {
                $arrayArticlesByUsers = $article->getArticlesByUser($_SESSION['user']['id']); 
            }
        }
        require_once(__DIR__ . '/../Views/home.view.php');
    }
}

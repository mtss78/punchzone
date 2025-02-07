<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Article;

class HomeController extends AbstractController
{
    public function index()
    {
        $articles = [];
        $articlesByUser = [];

        if (isset($_SESSION['user'])) {
            $articleModel = new Article(null, null, null, null, null, null, null);
            $articles = $articleModel->getAllArticles();
        }

        require_once(__DIR__ . '/../Views/home.view.php');
    }
}

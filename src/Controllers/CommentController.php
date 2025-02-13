<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController {
    
    public function addComment() {
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contenu = trim($_POST['contenu']);
            $article_id = $_POST['article_id'];
            $user_id = $_SESSION['user']['id'];

            if (!empty($contenu)) {
                $commentModel = new Comment();
                $commentModel->addComment($contenu, $user_id, $article_id);
            }
        }
        header("Location: /article?id=" . $article_id);
        exit();
    }
}

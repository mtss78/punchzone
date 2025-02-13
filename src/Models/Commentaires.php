<?php

namespace App\Models;

use PDO;
use Config\Database;

class Comment {
    private $pdo;

    public function __construct() {
    }

    // Ajouter un commentaire
    public function addComment($contenu, $user_id, $article_id) {
        $sql = "INSERT INTO commentaires (contenu, date_commentaire, user_id, id_article) 
                VALUES (:contenu, NOW(), :id_user, :id_article)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':contenu' => $contenu,
            ':id_user' => $user_id,
            ':article_id' => $article_id
        ]);
    }

    // Récupérer les commentaires d'un article
    public function getCommentsByArticle($article_id) {
        $sql = "SELECT c.*, u.username FROM comments c 
                JOIN users u ON c.id_user = u.id
                WHERE c.article_id = :article_id
                ORDER BY c.date_commentaire DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':article_id' => $article_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

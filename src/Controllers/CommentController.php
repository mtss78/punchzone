<?php

namespace App\Controllers;

use App\Models\Comment;
use Config\DataBase;
use PDO;

class CommentController
{
    private PDO $pdo;

    public function commentArticle()
    {
        $this->pdo = DataBase::getConnection();
    }

    // Ajouter un commentaire
    public function addComment($contenu, $date_commentaire, $article_id, $user_id)
    {
        $sql = "INSERT INTO `comment` (`contenu`, `date_commentaire`, `id_article`, `id_user`) 
                VALUES (:contenu, :date_commentaire, :id_article, :id_user)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'contenu' => $contenu,
            'date_commentaire' => $date_commentaire,
            'id_article' => $article_id,
            'id_user' => $user_id
        ]);
    }

    // Lire un commentaire par ID
    public function getCommentById($id)
    {
        $sql = "SELECT * FROM `comment` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lire tous les commentaires d'un article
    public function getCommentsByArticle($article_id)
    {
        $sql = "SELECT * FROM `comment` WHERE `id_article` = :id_article ORDER BY `date_commentaire` DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_article' => $article_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un commentaire
    public function updateComment($id, $contenu)
    {
        $sql = "UPDATE `comment` SET `contenu` = :contenu WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'contenu' => $contenu,
            'id' => $id
        ]);
    }

    // Supprimer un commentaire
    public function deleteComment($id)
    {
        $sql = "DELETE FROM `comment` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>

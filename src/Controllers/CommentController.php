<?php

namespace App\Controllers;

use App\Models\Comment;
use Config\DataBase;
use PDO;
use PDOException;

class CommentController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DataBase::getConnection();
    }

    // Ajouter un commentaire
    public function addComment($contenu, $date_commentaire, $article_id, $user_id)
    {
        try {
            $sql = "INSERT INTO `comment` (`contenu`, `date_commentaire`, `article_id`, `user_id`) 
                    VALUES (:contenu, :date_commentaire, :article_id, :user_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'contenu' => $contenu,
                'date_commentaire' => $date_commentaire,
                'article_id' => $article_id,
                'user_id' => $user_id
            ]);
            return true;
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
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
        $sql = "SELECT * FROM `comment` WHERE `article_id` = :article_id ORDER BY `date_commentaire` DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['article_id' => $article_id]);
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

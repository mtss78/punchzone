<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Comment
{
    protected ?int $id;
    protected ?string $contenu;
    protected ?string $dateCommentaire;
    protected ?int $articleId;
    protected ?int $userId;

    public function __construct(
        ?int $id = null,
        ?string $contenu = null,
        ?string $dateCommentaire = null,
        ?int $articleId = null,
        ?int $userId = null
    ) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->dateCommentaire = $dateCommentaire;
        $this->articleId = $articleId;
        $this->userId = $userId;
    }

    // Ajouter un commentaire
    public function addComment(): bool
    {
        {
            $pdo = DataBase::getConnection();
            $sql = "INSERT INTO `commentaires` (`contenu`, `date_commentaire`, `id_user`,`id_article`) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                $this->contenu,
                $this->dateCommentaire,
                $this->userId,
                $this->articleId
            ]);
        }  
    }

    // Lire un commentaire par ID
    public static function getCommentById(int $id): ?self
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `commentaires` WHERE `id_article` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new self(
            $row['id'],
            $row['contenu'],
            $row['date_commentaire'],
            $row['id_article'],
            $row['id_user']
        ) : null;
    }

    // Récupérer tous les commentaires d'un article
    public static function getCommentsByArticle(int $articleId): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `commentaires` WHERE `id_article` = ? ORDER BY `date_commentaire` DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$articleId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self(
            $row['id'],
            $row['contenu'],
            $row['date_commentaire'],
            $row['id_article'],
            $row['id_user']
        ), $rows);
    }

    // Mettre à jour un commentaire
    public function updateComment(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "UPDATE `commentaires` SET `contenu` = ? WHERE `id_user` = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                $this->contenu,
                $this->id
            ]);
        } catch (\Exception $e) {
            error_log("Erreur SQL: " . $e->getMessage());
            return false;
        }
    }

    // Supprimer un commentaire
    public function deleteComment(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "DELETE FROM `commentaires` WHERE `id` = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$this->id]);
        } catch (\Exception $e) {
            error_log("Erreur SQL: " . $e->getMessage());
            return false;
        }
    }

    // Getters et Setters
    public function getId(): ?int { return $this->id; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getDateCommentaire(): ?string { return $this->dateCommentaire; }
    public function getArticleId(): ?int { return $this->articleId; }
    public function getUserId(): ?int { return $this->userId; }

    public function setId(?int $id): static { $this->id = $id; return $this; }
    public function setContenu(?string $contenu): static { $this->contenu = $contenu; return $this; }
    public function setDateCommentaire(?string $dateCommentaire): static { $this->dateCommentaire = $dateCommentaire; return $this; }
    public function setArticleId(?int $articleId): static { $this->articleId = $articleId; return $this; }
    public function setUserId(?int $userId): static { $this->userId = $userId; return $this; }
}

<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Commentaire
{
    protected ?int $id;
    protected ?string $contenu;
    protected ?string $dateCommentaire;
    protected ?int $articleId;
    protected ?int $userId;

    public function __construct(
        ?int $id, 
        ?string $contenu,
        ?string $dateCommentaire,
        ?int $articleId,
        ?int $userId
    ) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->dateCommentaire = $dateCommentaire;
        $this->articleId = $articleId;
        $this->userId = $userId;
    }

    // Ajouter un commentaire
    public function addCommentaire(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "INSERT INTO `commentaires` (`contenu`, `date_commentaire`, `article_id`, `user_id`) 
                    VALUES (?, ?, ?, ?)";
            $statement = $pdo->prepare($sql);
            return $statement->execute([
                $this->contenu,
                $this->dateCommentaire,
                $this->articleId,
                $this->userId
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    // Lire un commentaire par ID
    public function getCommentaireById(): ?Commentaire
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `commentaires` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Commentaire(
                $row['id'],
                $row['contenu'],
                $row['date_commentaire'],
                $row['article_id'],
                $row['user_id']
            );
        }
        return null;
    }

    // Lire tous les commentaires liés à un article
    public static function getCommentairesByArticleId(int $articleId): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `commentaires`.*, `user`.`pseudo` 
                FROM `commentaires`
                LEFT JOIN `user` ON `commentaires`.`user_id` = `user`.`id`
                WHERE `commentaires`.`article_id` = ?
                ORDER BY `date_commentaire` DESC";
        $statement = $pdo->prepare($sql);
        $statement->execute([$articleId]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $commentaires = [];
        foreach ($result as $row) {
            $commentaire = new Commentaire(
                $row['id'],
                $row['contenu'],
                $row['date_commentaire'],
                $row['article_id'],
                $row['user_id']
            );
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }

    // Mettre à jour un commentaire
    public function updateCommentaire(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "UPDATE `commentaires` 
                    SET `contenu` = ?, `date_commentaire` = ?
                    WHERE `id` = ?";
            $statement = $pdo->prepare($sql);
            return $statement->execute([
                $this->contenu,
                $this->dateCommentaire,
                $this->id
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    // Supprimer un commentaire
    public function deleteCommentaire(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "DELETE FROM `commentaires` WHERE `id` = ?";
            $statement = $pdo->prepare($sql);
            return $statement->execute([$this->id]);
        } catch (\Exception $e) {
            return false;
        }
    }

    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function getDateCommentaire(): ?string
    {
        return $this->dateCommentaire;
    }

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function setDateCommentaire(?string $dateCommentaire): static
    {
        $this->dateCommentaire = $dateCommentaire;
        return $this;
    }

    public function setArticleId(?int $articleId): static
    {
        $this->articleId = $articleId;
        return $this;
    }

    public function setUserId(?int $userId): static
    {
        $this->userId = $userId;
        return $this;
    }
}

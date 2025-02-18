<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Comment
{
    protected ?int $id;
    protected ?string $contenu;
    protected ?string $date_commentaire;
    protected ?int $id_user;
    protected ?int $id_article;

    public function commentArticle(?int $id, ?string $contenu, ?string $date_commentaire, ?int $id_user, ?int $id_article)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date_commentaire = $date_commentaire;
        $this->id_user = $id_user;
        $this->id_article = $id_article;
    }

    public function addComment(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `commentaires` (`contenu`, `date_commentaire`, `id_user`, `id_article`) VALUES (?, NOW(), ?, ?)";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->contenu, $this->id_user, $this->id_article]);
    }

    public function deleteComment(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `commentaires` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    public static function getCommentsByArticleId(int $id_article): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT c.*, u.pseudo AS username FROM `commentaires` c 
                JOIN `users` u ON c.id_user = u.id 
                WHERE c.id_article = ? ORDER BY c.date_commentaire DESC";
        $statement = $pdo->prepare($sql);
        $statement->execute([$id_article]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getDateCommentaire(): ?string { return $this->date_commentaire; }
    public function getIdUser(): ?int { return $this->id_user; }
    public function getIdArticle(): ?int { return $this->id_article; }

    // Setters
    public function setId(?int $id): static { $this->id = $id; return $this; }
    public function setContenu(?string $contenu): static { $this->contenu = $contenu; return $this; }
    public function setDateCommentaire(?string $date_commentaire): static { $this->date_commentaire = $date_commentaire; return $this; }
    public function setIdUser(?int $id_user): static { $this->id_user = $id_user; return $this; }
    public function setIdArticle(?int $id_article): static { $this->id_article = $id_article; return $this; }
}

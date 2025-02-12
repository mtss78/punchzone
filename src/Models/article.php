<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Article
{
    protected ?int $id;
    protected ?string $titre;
    protected ?string $auteur;
    protected ?string $contenu;
    protected ?string $image;
    protected ?string $date_publication;
    protected ?int $id_user;

    public function __construct(?int $id, ?string $titre, ?string $auteur, ?string $contenu, ?string $image, ?string $date_publication, ?int $id_user)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->contenu = $contenu;
        $this->image = $image;
        $this->date_publication = $date_publication;
        $this->id_user = $id_user;
    }

    public function addArticle(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "INSERT INTO `article` (`titre`, `auteur`, `contenu`, `image`, `date_publication`, `id_user`) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->titre, $this->auteur, $this->contenu, $this->image, $this->date_publication, $this->id_user]);
    }

public function getAllArticles()
{
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM article ORDER BY date_publication DESC");
    $stmt->execute();
    $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC); // Vérifie si ça retourne un tableau associatif

    $articles = [];
    foreach ($articlesData as $article) {
        $articles[] = new Article(
            $article['id'],
            $article['titre'],
            $article['auteur'],
            $article['contenu'],
            $article['image'],
            $article['date_publication'],
            $article['id_user']
        );
    }

    return $articles; // Retourne un tableau d'objets Article
}

    public function getArticleById()
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `article` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Article($row['id'], $row['titre'], $row['auteur'], $row['contenu'], $row['image'], $row['date_publication'], $row['id_user']);
        }
        return null;
    }

    public function updateArticle(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "UPDATE `article` SET `titre` = ?, `contenu` = ?, `image` = ? WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->titre, $this->contenu, $this->image, $this->id]);
    }

    public function deleteArticle(): bool
    {
        $pdo = DataBase::getConnection();
        $sql = "DELETE FROM `article` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        return $statement->execute([$this->id]);
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getTitre(): ?string { return $this->titre; }
    public function getAuteur(): ?string { return $this->auteur; }
    public function getContenu(): ?string { return $this->contenu; }
    public function getImage(): ?string { return $this->image; }
    public function getDatePublication(): ?string { return $this->date_publication; }
    public function getIdUser(): ?int { return $this->id_user; }

    // Setters
    public function setId(?int $id): static { $this->id = $id; return $this; }
    public function setTitre(?string $titre): static { $this->titre = $titre; return $this; }
    public function setAuteur(?string $auteur): static { $this->auteur = $auteur; return $this; }
    public function setContenu(?string $contenu): static { $this->contenu = $contenu; return $this; }
    public function setImage(?string $image): static { $this->image = $image; return $this; }
    public function setDatePublication(?string $date_publication): static { $this->date_publication = $date_publication; return $this; }
    public function setIdUser(?int $id_user): static { $this->id_user = $id_user; return $this; }
}

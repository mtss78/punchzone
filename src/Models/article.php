<?php

namespace App\Models;

use Config\DataBase;
use PDO;

class Article
{
    protected ?int $id;
    protected ?string $titre;
    protected ?string $contenu;
    protected ?string $datePublication;
    protected ?int $auteurId;
    protected ?int $categorieId;

    public function __construct(
        ?int $id,
        ?string $titre,
        ?string $contenu,
        ?string $datePublication,
        ?int $auteurId,
        ?int $categorieId
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->datePublication = $datePublication;
        $this->auteurId = $auteurId;
        $this->categorieId = $categorieId;
    }

    // Ajouter un article
    public function addArticle(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "INSERT INTO `article` (`titre`, `contenu`, `date_publication`, `auteur_id`, `categorie_id`) 
                    VALUES (?, ?, ?, ?, ?)";
            $statement = $pdo->prepare($sql);
            return $statement->execute([
                $this->titre,
                $this->contenu,
                $this->datePublication,
                $this->auteurId,
                $this->categorieId
            ]);
        } catch (\Exception $e) {
            // Gérer l'exception
            return false;
        }
    }

    // Lire un article par ID
    public function getArticleById(): ?Article
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `article` WHERE `id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Article(
                $row['id'],
                $row['titre'],
                $row['contenu'],
                $row['date_publication'],
                $row['auteur_id'],
                $row['categorie_id']
            );
        }
        return null;
    }

    // Lire tous les articles avec jointure sur les catégories
    public static function getAllArticles(): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT `article`.*, `categories`.`mma` AS categorie_nom 
                FROM `article`
                LEFT JOIN `categories` ON `article`.`categorie_id` = `categories`.`id`";
        $statement = $pdo->query($sql);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];
        foreach ($result as $row) {
            $article = new Article(
                $row['id'],
                $row['titre'],
                $row['contenu'],
                $row['date_publication'],
                $row['auteur_id'],
                $row['categorie_id']
            );
            $articles[] = $article;
        }
        return $articles;
    }
    
    // Récupérer tous les articles associés à un utilisateur spécifique.
    public function getArticlesByUser(int $userId): array
    {
        $pdo = DataBase::getConnection();
        $sql = "SELECT * FROM `article` WHERE `auteur_id` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$userId]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];
        foreach ($result as $row) {
            $articles[] = new Article(
                $row['id'],
                $row['titre'],
                $row['contenu'],
                $row['date_publication'],
                $row['auteur_id'],
                $row['categorie_id']
            );
        }
        return $articles;
    }


    // Mettre à jour un article
    public function updateArticle(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "UPDATE `article` 
                    SET `titre` = ?, `contenu` = ?, `date_publication` = ?, `categorie_id` = ?
                    WHERE `id` = ?";
            $statement = $pdo->prepare($sql);
            return $statement->execute([
                $this->titre,
                $this->contenu,
                $this->datePublication,
                $this->categorieId,
                $this->id
            ]);
        } catch (\Exception $e) {
            // Gérer l'exception
            return false;
        }
    }

    // Supprimer un article
    public function deleteArticle(): bool
    {
        try {
            $pdo = DataBase::getConnection();
            $sql = "DELETE FROM `article` WHERE `id` = ?";
            $statement = $pdo->prepare($sql);
            return $statement->execute([$this->id]);
        } catch (\Exception $e) {
            // Gérer l'exception
            return false;
        }
    }

    // Getters et Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function getDatePublication(): ?string
    {
        return $this->datePublication;
    }

    public function getAuteurId(): ?int
    {
        return $this->auteurId;
    }

    public function getCategorieId(): ?int
    {
        return $this->categorieId;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;
        return $this;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function setDatePublication(?string $datePublication): static
    {
        $this->datePublication = $datePublication;
        return $this;
    }

    public function setAuteurId(?int $auteurId): static
    {
        $this->auteurId = $auteurId;
        return $this;
    }

    public function setCategorieId(?int $categorieId): static
    {
        $this->categorieId = $categorieId;
        return $this;
    }
}

<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Article;
use App\Models\Comment;

class ArticleController extends AbstractController
{

    public function index()
    {
        // Création d'une instance de la classe Article
        $article = new Article(null, null, null, null, null, null, null);
        
        // Récupération de tous les articles
        $allArticles = $article->getAllArticles();
    
        // Vérification si aucun article n'est trouvé
        if (!$allArticles) {
            $_SESSION['error'] = "Aucun article trouvé.";
            $this->redirectToRoute('/');
            exit;
        }
    
        // Inclusion de la vue pour afficher les articles
        require_once(__DIR__ . "/../Views/article/article.view.php");
    }
    
    public function detailArticle()
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $this->redirectToRoute('/article');
            return;
        }
    
        $articleId = intval($_GET['id']);
        $articleModel = new Article($articleId, null, null, null, null, null, null);
        $article = $articleModel->getArticleById();
    
        if (!$article) {
            $this->redirectToRoute('/article');
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            if (isset($_POST['contenu'], $_SESSION['user']) && !empty($_POST['contenu'])) {
                $commentaire = trim($_POST['contenu']);
                $id_user = $_SESSION['user']['id_user'];
                $date_creation = date('Y-m-d');
                $comments = new Comment(null, $commentaire, $date_creation, $articleId, $id_user);
                $comments->addComment();
    
                header('Location: /detailArticle?id=' . $articleId);
                exit();
            }
    
            if (isset($_POST['idupdate'], $_POST['contenu_update'], $_SESSION['user']) && !empty($_POST['contenu_update'])) {
                $idcomment = intval($_POST['idupdate']);
                $commentaire = trim($_POST['contenu_update']);
                $comments = new Comment($idcomment, $commentaire, null, null, null);
                $comments->updateComment();
    
                header('Location: /detailArticle?id=' . $articleId);
                exit();
            }
    
            if (isset($_POST['iddelete'], $_SESSION['user'])) {
                $idcomment = intval($_POST['iddelete']);
                $comments = new Comment($idcomment, null, null, null, null);
                $comments->deleteComment();
    
                header('Location: /detailArticle?id=' . $articleId);
                exit();
            }
        }
    
        $comment = new Comment(null, null, null, null, $articleId, null);
        $commentsaffichage = $comment->getCommentsByArticle($articleId);
    
        require_once(__DIR__ . "/../Views/article/detailArticle.view.php");
    }
    
    

    public function createArticle()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 1) {
            if (isset($_POST['titre'])) {
                $this->check('titre', $_POST['titre']);
                $this->check('contenu', $_POST['contenu']);

                if (empty($this->arrayError)) {
                    $titre = htmlspecialchars($_POST['titre']);
                    $auteur = $_SESSION['user']['pseudo'];
                    $contenu = htmlspecialchars($_POST['contenu']);

                    $date_publication = date('Y-m-d');
                    $id_user = $_SESSION['user']['id_user'];

                // chemin du dossier ou je stock les images de mes articles
                $target_dir = "public/img/";
                //variable qui contient le chemin et concatene le nom de mon image
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                // si mon image a bien été déplacé dans mon dossier voulu je récupere le nom de mon image dans une variable
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $img = htmlspecialchars(basename($_FILES["image"]["name"]));
                        $img_path =  $img;
                    }

                    $article = new Article(null, $titre, $auteur, $contenu, $img, $date_publication, $id_user);
                    $article->addArticle();

                    $this->redirectToRoute('/');
                }
            }
            require_once(__DIR__ . "/../Views/article/createArticle.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function editArticle()
    {
        if (isset($_GET['id'])) {
            $idArticle = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if (!$idArticle) {
                $this->redirectToRoute('/');
                exit;
            }

            $article = new Article($idArticle, null, null, null, null, null, null);
            $myArticle = $article->getArticleById();

            if (!$myArticle) {
                $_SESSION['error'] = "L'article n'existe pas.";
                $this->redirectToRoute('/');
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->check('titre', $_POST['titre']);
                $this->check('contenu', $_POST['contenu']);

                if (empty($this->arrayError)) {
                    $titre = htmlspecialchars($_POST['titre']);
                    $contenu = htmlspecialchars($_POST['contenu']);
                    $image = htmlspecialchars($_POST['image'] ?? '');

                    $article = new Article(
                        $idArticle,
                        $titre,
                        $myArticle->getAuteur(),
                        $contenu,
                        $image,
                        $myArticle->getDatePublication(),
                        $myArticle->getIdUser()
                    );

                    $article->updateArticle();
                    $_SESSION['success'] = "L'article a été mis à jour avec succès.";
                    $this->redirectToRoute('/');
                    exit;
                }
            }

            require_once(__DIR__ . "/../Views/article/editArticle.view.php");
        } else {
            $_SESSION['error'] = "ID d'article invalide.";
            $this->redirectToRoute('/');
            exit;
        }
    }


    public function deleteArticle()
    {
        if (isset($_POST['id'])) {
            $idArticle = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if ($idArticle) {
                $article = new Article($idArticle, null, null, null, null, null, null);
                $article->deleteArticle();
            }
            $this->redirectToRoute('/');
        }
    }
}

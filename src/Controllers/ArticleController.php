<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Article;
use App\Models\User;

class ArticleController extends AbstractController
{
    public function getAllArticles()
    {
        $articleModel = new Article(null, null, null, null, null, null, null);
        $articles = $articleModel->getAllArticles();
        
        require_once(__DIR__ . '/../Views/article.view.php');
    }

    public function showArticle()
    {
        if (isset($_GET['id'])) {
            $idArticle = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if (!$idArticle) {
                $this->redirectToRoute('/');
            }

            $article = new Article($idArticle, null, null, null, null, null, null);
            $myArticle = $article->getArticleById();

            if (!$myArticle) {
                $this->redirectToRoute('/');
            }

            $idUser = $myArticle->getIdUser();
            $user = new User($idUser, null, null, null, null, null);
            $myUser = $user->getUserById();

            require_once(__DIR__ . "/../Views/article.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function createArticle()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 1) {
            if (isset($_POST['titre'])) {
                $this->check('titre', $_POST['titre']);
                $this->check('contenu', $_POST['contenu']);

                if (empty($this->arrayError)) {
                    $titre = htmlspecialchars($_POST['titre']);
                    $contenu = htmlspecialchars($_POST['contenu']);
                    $auteur = $_SESSION['user']['username'];
                    $image = htmlspecialchars($_POST['image'] ?? '');
                    $date_publication = date('Y-m-d');
                    $id_user = $_SESSION['user']['id_user'];

                    $article = new Article(null, $titre, $auteur, $contenu, $image, $date_publication, $id_user);
                    $article->addArticle();

                    $this->redirectToRoute('/');
                }
            }
            require_once(__DIR__ . '/../Views/createArticle.view.php');
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
            }

            $article = new Article($idArticle, null, null, null, null, null, null);
            $myArticle = $article->getArticleById();

            if (!$myArticle) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['titre'])) {
                $this->check('titre', $_POST['titre']);
                $this->check('contenu', $_POST['contenu']);

                if (empty($this->arrayError)) {
                    $titre = htmlspecialchars($_POST['titre']);
                    $contenu = htmlspecialchars($_POST['contenu']);
                    $image = htmlspecialchars($_POST['image'] ?? '');

                    $article = new Article($idArticle, $titre, $myArticle->getAuteur(), $contenu, $image, null, null);
                    $article->updateArticle();

                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/editArticle.view.php');
        } else {
            $this->redirectToRoute('/');
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

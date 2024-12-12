<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Article;

class ArticleController extends AbstractController
{
    public function index()
    {
        if ($_GET['id']) {
            // On récupère l'ID de l'article
            $idArticle = $_GET['id'];
            // Instancier un nouvel article avec l'ID
            $article = new Article($idArticle, null, null, null, null, null);
            // Récupérer l'article depuis la BDD
            $myArticle = $article->getArticleById();

            // Si l'article n'existe pas, redirection
            if (!$myArticle) {
                $this->redirectToRoute('/');
            }

            $creationDate = date_create($myArticle->getDatePublication());

            require_once(__DIR__ . "/../Views/article/article.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function createArticle()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['idRole'] == 1) {
            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('content', $_POST['content']);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $content = htmlspecialchars($_POST['content']);
                    $creation_date = date('Y-m-d H:i:s');
                    $id_user = $_SESSION['user']['idUser'];

                    $article = new Article(null, $title, $content, $creation_date, $id_user, null);

                    $article->addArticle();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/article/createArticle.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function editArticle()
    {
        if ($_GET['id']) {
            // On récupère l'ID de l'article
            $idArticle = $_GET['id'];
            // Instancier un nouvel article avec l'ID
            $article = new Article($idArticle, null, null, null, null, null);
            // Récupérer l'article depuis la BDD
            $myArticle = $article->getArticleById();

            // Si l'article n'existe pas, redirection
            if (!$myArticle) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['title'])) {
                $this->check('title', $_POST['title']);
                $this->check('content', $_POST['content']);

                if (empty($this->arrayError)) {
                    $title = htmlspecialchars($_POST['title']);
                    $content = htmlspecialchars($_POST['content']);

                    $article = new Article($idArticle, $title, $content, null, null, null);

                    $article->updateArticle();
                    $this->redirectToRoute('/');
                }
            }

            require_once(__DIR__ . '/../Views/article/editArticle.view.php');
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function deleteArticle()
    {
        if (isset($_POST['id'])) {
            $idArticle = htmlspecialchars($_POST['id']);
            $article = new Article($idArticle, null, null, null, null, null);
            $article->deleteArticle();
            $this->redirectToRoute('/');
        }
    }
}

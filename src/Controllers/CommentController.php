<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Comment;

class CommentController extends AbstractController
{
    public function commentArticle()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Vous devez être connecté pour commenter.";
            $this->redirectToRoute('/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_article'], $_POST['contenu'])) {
            $this->check('contenu', $_POST['contenu']);

            if (empty($this->arrayError)) {
                $contenu = htmlspecialchars($_POST['contenu']);
                $id_article = intval($_POST['id_article']);
                $user_id = $_SESSION['user']['id_user'];

                $comment = new Comment(null, $contenu, null, $user_id, $id_article);
                $comment->addComment();

                $_SESSION['success'] = "Commentaire ajouté avec succès.";
            } else {
                $_SESSION['error'] = "Le contenu du commentaire est invalide.";
            }
        }

        $this->redirectToRoute('/article?id=' . $_POST['id_article']);
    }

    public function deleteComment()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Vous devez être connecté pour supprimer un commentaire.";
            $this->redirectToRoute('/login');
            return;
        }

        if (isset($_POST['id'])) {
            $idComment = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if ($idComment) {
                $comment = new Comment($idComment, null, null, null, null);
                $comment->deleteComment();
                $_SESSION['success'] = "Commentaire supprimé avec succès.";
            } else {
                $_SESSION['error'] = "ID du commentaire invalide.";
            }
        }

        $this->redirectToRoute('/');
    }
}

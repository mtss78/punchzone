<?php
require "vendor/autoload.php";
session_start();

use App\Controllers\ArticleController;
use Config\Router;

$router = new Router();

/** j'utilise la methode addRouute de mon controller pour ajouter des routes au controller
 *  cette methode prends trois argument, la route, le controller et la methode executé
 */
//la page d'accueil
$router->addRoute('/', 'HomeController', 'index');
//La connexion/deconnexion et inscription:
$router->addRoute('/register', 'RegisterController', 'index');
$router->addRoute('/login', 'LoginController', 'index');
$router->addRoute('/logout', 'LogoutController', 'logout');
//Le CRUD:
$router->addRoute('/addArticle', 'ArticleController', 'createArticle');
$router->addRoute('/article', 'ArticleController', 'index');
$router->addRoute('/detailArticle', 'ArticleController', 'detailArticle');
$router->addRoute('/editArticle', 'ArticleController', 'editArticle');
$router->addRoute('/deleteArticle', 'ArticleController', 'deleteArticle');
$router->addRoute('/addComment', 'CommentController', 'commentArticle');
$router->addRoute('/deleteComment', 'CommentController', 'commentArticle');

$router->addRoute('/ranking', 'RankingController', 'index');
$router->addRoute('/Mentionslegales', 'MentionslegalesController', 'index');


$router->handleRequest();
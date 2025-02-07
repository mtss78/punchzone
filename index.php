<?php
require "vendor/autoload.php";
session_start();

use App\Controllers\ArticleController;
use Config\Router;

$router = new Router();

/** j'utilise la methode addRouute de mon controller pour ajouter des routes au controller
 *  cette methode prends trois argument, la route, le controller et la methode executé
 */
$router->addRoute('/', 'HomeController', 'index');
//La connexion/deconnexion et inscription:
$router->addRoute('/register', 'RegisterController', 'index');
$router->addRoute('/login', 'LoginController', 'index');
$router->addRoute('/logout', 'LogoutController', 'logout');
//Le CRUD:
$router->addRoute('/addArticle', 'ArticleController', 'createArticle');
$router->addRoute('/Article', 'ArticleController', 'index');
$router->addRoute('/editArticle', 'ArticleController', 'editArticle');

$router->handleRequest();
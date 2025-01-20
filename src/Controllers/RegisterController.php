<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    public function index()
    {

        if (isset($_POST['pseudo'], $_POST['mail'], $_POST['password'])) {
            $this->check('pseudo', $_POST['pseudo']);
            $this->check('mail', $_POST['mail']);
            $this->check('password', $_POST['password']);
           

            if (empty($this->arrayError)) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mail = htmlspecialchars($_POST['mail']);
                $password = htmlspecialchars($_POST['password']);
                $id_role = isset($_POST['idRole']) ? htmlspecialchars($_POST['idRole']) : null;
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $user = new User(null, $pseudo, $mail, $passwordHash, null, $id_role);
                $user->save();
                $this->redirectToRoute('/');
            }
        }
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}
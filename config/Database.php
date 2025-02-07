<?php

namespace Config;

use PDO;
use Exception;

class DataBase
{
    static function getConnection()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=punchzone1;charset=utf8', 'root');
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
        return $pdo;
    }
}
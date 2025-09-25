<?php

namespace App\Models;

use PDO;

class DataBase
{
    

    public static function getConnection()
    {
        
        $dbHost = 'localhost';
        $dbUser = 'estudos';
        $dbPassword = 'estudos@1';
        $dbname = 'fabio_ar_condicionado';
        $dbConfig = "mysql:host={$dbHost};dbname={$dbname}";

        $pdo = new PDO($dbConfig, $dbUser, $dbPassword);

        return $pdo;
    }
}

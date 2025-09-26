<?php

namespace App\Models;

use App\Models\DataBase;
use App\Services\AdminService;
use PDO;

class Admin extends DataBase
{
    public static function loginAdmin(array $data)
    {
       
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM login");

        $stmt->execute();

        $dbDadosLogin = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($dbDadosLogin as $login)
        {
            $senhaDecriptografada = AdminService::descritografar($login['senha']);

            if($login['usuario'] == $data['usuario'] && $senhaDecriptografada == $data['senha'])
            {
                return 'autorizado';
            } else {
                return 'negado';
            }
        }

        
    }
}
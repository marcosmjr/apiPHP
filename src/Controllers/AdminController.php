<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Admin;

class AdminController
{
    public function loginAdmin(Request $request, Response $response)
    {
     
        $body = $request::body();

        $AdminModel = Admin::loginAdmin($body);

        if($AdminModel == 'autorizado')
        {

            $response::json([
                'error'   => false,
                'success' => true,
                'message' => 'Acesso autorizado.',
            ],201);
        
        } else {

            $response::json([
                'error'   => false,
                'success' => true,
                'message' => 'Acesso negado.',
            ],400);

        }
    
    }
}
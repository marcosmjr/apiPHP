<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
//use App\Services\ClienteService;
use App\Models\Cliente;

class ClienteController
{
    public function cadastrarCliente(Request $request, Response $response)
    {
        $body = $request::body();

        //$clienteService = ClienteService::create($body);

        $clienteModel = Cliente::cadastrarCliente($body);

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Cadastro realizado com sucesso.',
           // 'data'    =>  $clienteModel   //  $clienteService
        ],201);
    }

    public function buscarTodosClientes(Request $request, Response $response)
    {
            $body = $request::body();
    }

    public function procurarCliente(Request $request, Response $response)
    {
        
    }

    public function buscarOcorrencias(Request $request, Response $response)
    {
        
    }

    public function removerCliente(Request $request, Response $response, array $id)
    {
        
    }
}
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

        $clienteModelCadastro = Cliente::cadastrarCliente($body);

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Cadastro realizado com sucesso.',
        ],201);
    }

    /*Busca todos os clientes e ocorrências no banco de dados*/
    public function buscarTodosClientes(Request $request, Response $response)
    {
            $body = $request::body();

            $clienteModelBusca = Cliente::buscarTodosClientes();

            print_r($clienteModelBusca); // retira
            
            $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Clientes encontrados.',
        ],200);

        return;

    }

    public function procurarCliente(Request $request, Response $response)
    {
         // Não sendo usado
    }

    public function buscarOcorrencias(Request $request, Response $response)
    {

            $ocorrenciasModelBusca = Cliente::buscarOcorrencias();

            print_r($ocorrenciasModelBusca); // retira
            
            $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Ocorrências encontradas.',
        ],200);

        return;
    }

    public function removerCliente(Request $request, Response $response, array $id)
    {
        
        
        $removerClienteModel = Cliente::removerCliente($id[0]);

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Registro apagado.',
        ],200);
    }

    public static function dataAtendimento(Request $request, Response $response, array $id)
    {
        Cliente::dataAtendimento($id[0]);

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Data de atendimento adicionada.',
        ],200);
    }
}
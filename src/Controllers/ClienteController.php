<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Cliente;

class ClienteController
{
    /**
     * Cadastra os clientes e as ocorrências.
     */
    public function cadastrarCliente(Request $request, Response $response)
    {
        $body = $request::body();

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
         
            $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Clientes encontrados.',
            'data'    => $clienteModelBusca,
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

            
            $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Ocorrências encontradas.',
            'data'    => $ocorrenciasModelBusca,
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
        ],204);
    }

    public static function dataAtendimento(Request $request, Response $response, array $id)
    {
        Cliente::dataAtendimento($id[0]);

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => 'Data de atendimento adicionada.',
        ],204);
    }
}
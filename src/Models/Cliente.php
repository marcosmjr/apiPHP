<?php

namespace App\Models;

use App\Models\DataBase;
use PDO;

Class Cliente extends DataBase
{
     public static function cadastrarCliente(array $data)
    {
        $dataHoje = date("Y-m-d");

        $pdo = self::getConnection();

            $stmt = $pdo->prepare("
                INSERT INTO abio_ar_condicionado.ocorrencias(
                servico_ocorrencias,
                data_ocorrencias,
                mensagem_ocorrencias
                )
                VALUES (?, $dataHoje, ?, , ?)
            ");

            $stmt->execute([
                $data['servico_ocorrencias'],
                $data['data_ocorrencias'],
                $data['mensagem_ocorrencias'],
            ]);

             $idOcorrencia = $pdo->lastInsertId();

        if ($data['nome_empresa_cliente_juridico'] == 'N/A' || empty($data['nome_empresa_cliente_juridico']))
        {     

            $stmt = $pdo->prepare("               

                INSERT INTO fabio_ar_condicionado.cliente_fisico
                (
                nome_cliente_fisico, 
                sobrenome_cliente_fisico, 
                rua_cliente_fisico,
                bairro_cliente_fisico,
                numero_cliente_fisico,
                cidade_cliente_fisico,
                estado_cliente_fisico,
                telefone_cliente_fisico,
                whatsapp_cliente_fisico,
                e_mail_cliente_fisico,
                preferencia_cliente_fisico,
                fk_ocorrencia
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, $idOcorrencia)
            ");

            $stmt->execute([
                $data['nome_cliente_fisico'],
                $data['sobrenome_cliente_fisico'],
                $data['rua_cliente_fisico'],
                $data['bairro_cliente_fisico'],
                $data['numero_cliente_fisico'],
                $data['cidade_cliente_fisico'],
                $data['estado_cliente_fisico'],
                $data['telefone_cliente_fisico'],
                $data['whatsapp_cliente_fisico'],
                $data['e_mail_cliente_fisico'],
                $data[' preferencia_cliente_fisico'],

            ]);


        } else {

            $stmt = $pdo->prepare("
                INSERT INTO fabio_ar_condicionado.cliente_juridico
                (
                nome_cliente_juridico, 
                sobrenome_cliente_juridico, 
                rua_cliente_juridico,
                bairro_cliente_juridico,
                numero_cliente_juridico,
                cidade_cliente_juridico,
                estado_cliente_juridico,
                telefone_cliente_juridico,
                whatsapp_cliente_juridico,
                e_mail_cliente_juridico,
                preferencia_cliente_juridico,
                nome_empresa_cliente_juridico,
                fk_ocorrencia
                )
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, $idOcorrencia)
            ");

            $stmt->execute([
                $data['nome_cliente_juridico'],
                $data['sobrenome_cliente_juridico'],
                $data['rua_cliente_juridico'],
                $data['bairro_cliente_juridico'],
                $data['numero_cliente_juridico'],
                $data['cidade_cliente_juridico'],
                $data['estado_cliente_juridico'],
                $data['telefone_cliente_juridico'],
                $data['whatsapp_cliente_juridico'],
                $data['e_mail_cliente_juridico'],
                $data['preferencia_cliente_juridico'],
                $data['nome_empresa_cliente_juridico'],
            ]);

        }

        return $pdo->lastInsertId() > 0 ? true : false;
    }

    public function buscarTodosClientes(Request $request, Response $response)
    {
            
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
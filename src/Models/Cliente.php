<?php

namespace App\Models;

use App\Models\DataBase;
use PDO;

class Cliente extends DataBase
{
    /**
     * Cadastro dos clientes e suas demandas (ocorrências) 
     */
    public static function cadastrarCliente(array $data)
    {
        $dataHoje = date("Y-m-d");

        $pdo = self::getConnection();

            $stmt = $pdo->prepare("
                INSERT INTO ocorrencias(
                servico_ocorrencias,
                data_ocorrencias,
                mensagem_ocorrencias
                )
                VALUES (?, '$dataHoje', ?)
            ");

            $stmt->execute([
                $data['servico_ocorrencias'],
                //$data['data_ocorrencias'],
                $data['mensagem_ocorrencias'],
            ]);

             $idOcorrencia = $pdo->lastInsertId();
             print_r($idOcorrencia);

        if ($data['nome_empresa_cliente'] == 'N/A' || empty($data['nome_empresa_cliente']))
        {     

            $stmt = $pdo->prepare("               

                INSERT INTO cliente_fisico
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
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '$idOcorrencia')
            ");

            $stmt->execute([
                $data['nome_cliente'],
                $data['sobrenome_cliente'],
                $data['rua_cliente'],
                $data['bairro_cliente'],
                $data['numero_cliente'],
                $data['cidade_cliente'],
                $data['estado_cliente'],
                $data['telefone_cliente'],
                $data['whatsapp_cliente'],
                $data['e_mail_cliente'],
                $data['preferencia_cliente'],

            ]);


        } else {

            $stmt = $pdo->prepare("
                INSERT INTO cliente_juridico
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
                $data['nome_cliente'],
                $data['sobrenome_cliente'],
                $data['rua_cliente'],
                $data['bairro_cliente'],
                $data['numero_cliente'],
                $data['cidade_cliente'],
                $data['estado_cliente'],
                $data['telefone_cliente'],
                $data['whatsapp_cliente'],
                $data['e_mail_cliente'],
                $data['preferencia_cliente'],
                $data['nome_empresa_cliente'],
            ]);

        }

        return $pdo->lastInsertId() > 0 ? true : false;
    }


     /*
     * Busca todos os clientes e ocorrências no banco de dados
     * O array $resultadoBusca é composto de um array de pessoas 
     * físicas no índice 0 e de pessoas jurídicas no índice 1
     * */
    public static function buscarTodosClientes()
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            SELECT * FROM ocorrencias
            JOIN cliente_fisico ON id_ocorrencias = cliente_fisico.fk_ocorrencia
        ");

        $stmt->execute();

        $clientes_fisicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("
            SELECT * FROM ocorrencias
            JOIN cliente_juridico ON id_ocorrencias = cliente_juridico.fk_ocorrencia
        ");

        $stmt->execute();

         $clientes_juridico = $stmt->fetchAll(PDO::FETCH_ASSOC);

         $resultadoBusca = [$clientes_fisicos, $clientes_juridico];

         return $resultadoBusca; //formado por arrays, clientes_fisicos e clientes_juridico
            
    }

    public static function procurarCliente()
    {
        // Não sendo usado
    }

    public static function buscarOcorrencias()
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM ocorrencias");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function removerCliente(int|string $id)
    {
        
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("DELETE FROM ocorrencias WHERE id_ocorrencias = ?");

        $stmt->execute([$id]);
        
    }

    public static function dataAtendimento()
    {
        $dataAtendimento = date("Y-m-d");
        
    }

}
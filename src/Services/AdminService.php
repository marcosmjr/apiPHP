<?php

namespace App\Services;

class AdminService
{
    // Defina os parâmetros
    private static $chave = "e5bbb3fd1536b390c011200732ffc3d7"; // 256 bits = 32 caracteres
    private static $cipher = "AES-256-CBC";


    public static function critografar($dados){      
              
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AdminService::$cipher));
        
        // Criptografar
        $criptografado = openssl_encrypt($dados, AdminService::$cipher, AdminService::$chave, 0, $iv);

        // Para armazenar ou transmitir, combine IV + dado criptografado em base64
        $criptografado_completo = base64_encode($iv . $criptografado);

        return $criptografado_completo;
    }


    public static function descritografar(string $dados)
    {
        // Para descriptografar
        $dados_recebidos = base64_decode($dados);
        $iv_recuperado = substr($dados_recebidos, 0, openssl_cipher_iv_length(AdminService::$cipher));
        $dados_criptografados = substr($dados_recebidos, openssl_cipher_iv_length(AdminService::$cipher));

        return openssl_decrypt($dados_criptografados, AdminService::$cipher, AdminService::$chave, 0, $iv_recuperado);
    }
}
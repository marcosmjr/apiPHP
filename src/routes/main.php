<?php

use App\Controllers\HomeController;
use App\Http\Route;

Route::get('/', 'HomeController@index');
Route::get('/cliente', 'HomeController@listaCliente'); // Busca todos os dados do cliente
Route::get('/cliente/{id}', 'HomeController@buscaClientes'); // Busca dados do cliente por id
Route::get('/ocorrencias', 'HomeController@ocorrencias'); // Busca as ocorrências
Route::get('/admin/login','HomeController@loginAdmin'); //Buscar senha para login do administrador
Route::post('/cliente/cadastro', 'HomeController@cadastrarClientes'); //Armazena o cadastro dos clientes
Route::delete('/cliente/{id}/delete', 'HomeController@remove'); // Remove um cliente
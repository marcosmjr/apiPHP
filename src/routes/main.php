<?php

use App\Controllers\ClienteController;
use App\Controllers\HomeController;
use App\Http\Route;

Route::get('/', 'HomeController@index');
Route::get('/cliente/buscatodos','ClienteController@buscarTodosClientes'); // Busca todos os clientes
Route::get('/cliente/{id}/busca',      'ClienteController@procurarCliente'); // Busca cliente por id
Route::get('/cliente/ocorrencias','ClienteController@buscarOcorrencias'); // Busca as ocorrências
Route::get('/admin/login',        'AdminController@loginAdmin'); //Busca dados do administrador
Route::post('/cliente/cadastro/contato',  'ClienteController@cadastrarCliente'); //Cadastra cliente
Route::delete('/cliente/{id}/remove', 'ClienteController@removerCliente'); // Remove um cliente
Route::put('/cliente/atendimento', 'ClienteController@dataAtendimento' ); // Atualiza a data de atendimento


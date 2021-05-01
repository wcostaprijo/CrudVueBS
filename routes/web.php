<?php

use Illuminate\Support\Facades\Route;

/**
 * Rota para o cliente selecionar o tipo da aplicacao
 */
Route::get('/', function () {
    return view('aplicacao.selecionar');
});

/**
 * Rotas para aplicacao Boostrap
 */
Route::resource('bootstrap/clientes', 'Bootstrap\\ClienteController');
Route::post('bootstrap/clientes/{id}/restore', 'Bootstrap\\ClienteController@restore')->name('clientes.restore');

/**
 * Rotas para aplicacao Vue.js
 */
Route::get('vue/{any}', function () {
    return view('vue.clientes');
})->where('any', '.*');

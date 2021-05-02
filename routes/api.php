<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::apiResource('clientes', 'Api\\Vue\\ClienteController', ['as' => 'vue']);
    Route::post('clientes/{id}/restore', 'Api\\Vue\\ClienteController@restore')->name('clientes.restore');
});

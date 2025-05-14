<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientesController;

//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');


Route::get('/teste', function () {
    return response()->json([
        'message' => 'Hello World'
    ]);
});

Route::get('/clientes', [ClientesController::class, 'getClientes']);
Route::get('/clientesbyid', [ClientesController::class, 'getClienteById']);
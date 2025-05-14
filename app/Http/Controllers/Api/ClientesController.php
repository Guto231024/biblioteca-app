<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function getClientes()
    {
        $clientes = Cliente::all();
        
        return response()->json($clientes);
    }

    public function getClienteById(Request $request){
        
            $id = $request->get('id');
        

        $cliente = Cliente::find($id);
        
        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
        return response()->json($cliente);
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        if ($request->ajax()) {
           
            $data = Cliente::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("cliente.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("cliente.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-outline-danger btn-sm ml-2")><i class="fas fa-trash"></i></button>
                        </form>
                    ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();  

        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $logradouro = $request->post('logradouro');
        $numero = $request->post('numero');
        $complemento = $request->post('complemento');
        $bairro = $request->post('bairro');
        $cidade = $request->post('cidade');
        $uf = $request->post('uf');
        $celular = $request->post('celular');
        $email = $request->post('email');

        $edit = new Cliente();

        $edit->nome = $nome;
        $edit->cpf = $cpf;
        $edit->cep = $cep;
        $edit->logradouro = $logradouro;
        $edit->numero = $numero;
        $edit->complemento = $complemento;
        $edit->bairro = $bairro;
        $edit->cidade = $cidade;
        $edit->uf = $uf;
        $edit->celular = $celular;
        $edit->email = $email;
        $edit->origin_user = $user->name;
        $edit->last_user = $user->name;
        $edit->save();

        return view('clientes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Cliente::find($id);

        $output = array(
            'edit' => $edit,
        );

        return view ('clientes.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();  
        $edit = Cliente::find($id);
        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $logradouro = $request->post('logradouro');
        $numero = $request->post('numero');
        $complemento = $request->post('complemento');
        $bairro = $request->post('bairro');
        $cidade = $request->post('cidade');
        $uf = $request->post('uf');
        $celular = $request->post('celular');
        $email = $request->post('email');


        $edit->nome = $nome;
        $edit->cpf = $cpf;
        $edit->cep = $cep;
        $edit->logradouro = $logradouro;
        $edit->numero = $numero;
        $edit->complemento = $complemento;
        $edit->bairro = $bairro;
        $edit->cidade = $cidade;
        $edit->uf = $uf;
        $edit->celular = $celular;
        $edit->email = $email;
        $edit->last_user = $user->name;
        $edit->update();

        return view('clientes.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $edit = Cliente::find($id);
        $edit->delete();

        return view('clientes.index');
    }
}

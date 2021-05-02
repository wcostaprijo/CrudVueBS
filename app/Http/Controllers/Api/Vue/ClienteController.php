<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Mostrar a lista de clientes cadastrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::when($request->has('excluidos'), function($query){
                $query->onlyTrashed();
            })
            ->when($request->has('cliente'), function($query) use($request){
                $query->where('nome_cliente','LIKE','%'.$request->cliente.'%');
            })->paginate(10);
        return response()->json($clientes, 200);
    }

    /**
     * Salvando um cliente novo no banco de dados.
     *
     * @param  \App\Http\Requests\Bootstrap\Cliente\Create  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Bootstrap\Cliente\Create $request)
    {
        $cliente = Cliente::create($request->validated());
        return response()->json(['success' => true, 'cliente' => $cliente]);
    }

    /**
     * Mostra um cliente especifico.
     *
     * @param  \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return response()->json($cliente, 200);
    }

    /**
     * Atualiza um cliente especifico.
     *
     * @param  \App\Http\Requests\Bootstrap\Cliente\Update  $request
     * @param  \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Bootstrap\Cliente\Update $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        return response()->json(['success' => true, 'cliente' => $cliente]);
    }

    /**
     * Deletar um cliente cadastrado.
     *
     * @param  \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Restaurar um cliente excluido.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if($cliente = Cliente::onlyTrashed()->find($id)) {
            $cliente->restore();
            return back()->with('success','Cliente restaurado com sucesso');
        }
        return back();
    }
}

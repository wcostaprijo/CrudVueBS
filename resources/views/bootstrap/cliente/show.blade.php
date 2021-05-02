@extends('bootstrap.layouts.app')

@section('title') {{ucwords(mb_strtolower($cliente->nome_cliente))}} @endsection

@section('content')
    <div class="container mt-5">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-sm-8 mb-5 border-bottom">
                <h4>{{ucwords(mb_strtolower($cliente->nome_cliente))}}</h4>
            </div>
            <div class="col-12 col-sm-8 mt-3">
                <ul class="list-group">
                    <li class="list-group-item">Data de nascimento: <strong>{{$cliente->dt_nasc_cliente}}</strong></li>
                    <li class="list-group-item">RG: <strong>{{$cliente->rg_cliente}}</strong></li>
                    <li class="list-group-item">CPF: <strong>{{$cliente->cpf_cliente}}</strong></li>
                    <li class="list-group-item">Celular: <strong>{{$cliente->telefone_cliente}}</strong></li>
                </ul>
            </div>

            <div class="col-12 col-sm-6 mt-5 border-top text-muted pt-2">
                Cliente cadastrado em {{$cliente->created_at}}
            </div>

            <div class="col-12 col-sm-6 mt-5 border-top pt-2 text-right">
                <a href="/bootstrap/clientes">Voltar a lista de clientes</a>
            </div>
        </div>
    </div>
@endsection
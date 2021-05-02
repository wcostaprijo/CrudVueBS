@extends('bootstrap.layouts.app')

@section('title') Atualização de cadastro @endsection

@section('content')
    <div class="container mt-5">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-sm-8 mb-5 border-bottom">
                <h4>Atualização de cadastro</h4>
            </div>
            @if ($errors->any())
                <div class="div.col-12 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12 col-sm-8 mt-3">
                <form method="POST" action="{{route('clientes.update', ['cliente' => $cliente])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="nome-cliente" class="col-sm-4 col-form-label">Nome</label>
                        <div class="col-sm-8">
                            <input name="nome_cliente" type="text" class="form-control" id="nome-cliente" placeholder="Informe nome do cliente" value="{{ old('nome_cliente') ?? $cliente->nome_cliente }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dt-nasc-cliente" class="col-sm-4 col-form-label">Data de nascimento</label>
                        <div class="col-sm-8">
                            <input name="dt_nasc_cliente" type="date" class="form-control" id="dt-nasc-cliente" placeholder="DD/MM/YYYY" value="{{ old('dt_nasc_cliente') ?? explode('/',$cliente->dt_nasc_cliente)[2].'-'.explode('/',$cliente->dt_nasc_cliente)[1].'-'.explode('/',$cliente->dt_nasc_cliente)[0] }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rg-cliente" class="col-sm-4 col-form-label">RG</label>
                        <div class="col-sm-8">
                            <input name="rg_cliente" type="text" class="form-control" id="rg-cliente" placeholder="Informe RG do cliente" value="{{ old('rg_cliente') ?? $cliente->rg_cliente }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cpf-cliente" class="col-sm-4 col-form-label">CPF</label>
                        <div class="col-sm-8">
                            <input name="cpf_cliente" type="text" class="form-control" id="cpf-cliente" placeholder="Informe CPF do cliente" value="{{ old('cpf_cliente') ?? $cliente->cpf_cliente }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefone-cliente" class="col-sm-4 col-form-label">Celular</label>
                        <div class="col-sm-8">
                            <input name="telefone_cliente" type="text" class="form-control" id="telefone-cliente" placeholder="99 9 9999-9999" value="{{ old('telefone_cliente') ?? $cliente->telefone_cliente }}" required>
                        </div>
                    </div>

                    <button class="btn btn-primary mt-5">Salvar alterações</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script src="/bootstrap/cliente/js/create.js"></script>
@endsection
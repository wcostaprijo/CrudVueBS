@extends('bootstrap.layouts.app')

@section('title') Clientes @endsection

@section('content')
    <div class="container">
        <div class="row mt-4 mb-2 justify-content-md-end">
            <div class="col-6">
                <h4>Clientes cadastrados</h4>
            </div>
            <div class="col-6 text-right">
                <form method="get">
                    <div class="input-group">
                        <input name="cliente" type="text" class="form-control" placeholder="Insira o nome do cliente" value="{{ request()->cliente ?? '' }}" autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="/bootstrap/clientes/create" class="btn btn-success">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            @if(request()->has('cliente') AND !empty(request()->cliente))
                <div class="col-6 mt-4">
                    Mostrando resultados para <strong>{{request()->cliente}}</strong>. <a href="/bootstrap/clientes">Limpar filtro</a>
                </div>
            @endif

            @if(request()->has('excluidos'))
                <div class="col-6 mt-4 text-right">
                    Mostrando clientes excluídos. <a href="/bootstrap/clientes">Mostrar clientes não excluídos</a>
                </div>
            @else
                <div class="col-6 mt-4 text-right">
                    <a href="/bootstrap/clientes?excluidos">Mostrar clientes excluídos</a>
                </div>
            @endif
        </div>
        <div class="row">
            @if(session('success'))
                <div class="col-12 alert alert-success">{{session('success')}}</div>
            @endif
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">RG</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ucwords(mb_strtolower($cliente->nome_cliente))}}</th>
                                <td>{{$cliente->dt_nasc_cliente}}</td>
                                <td>{{$cliente->rg_cliente}}</td>
                                <td>{{$cliente->cpf_cliente}}</td>
                                <td>{{$cliente->telefone_cliente}}</td>
                                <td class="text-center">
                                    @if($cliente->trashed())
                                        <form class="d-inline-block p-0" action="{{route('clientes.restore', $cliente->id_cliente)}}" method="post">
                                            @csrf
                                            <button class="text-info btn btn-link p-0 m-0"><i class="fas fa-redo"></i></button>
                                        </form>
                                    @else
                                        <a href="{{route('clientes.show', ['cliente' => $cliente])}}" class="text-dark mr-2"><i class="fas fa-eye"></i></a>
                                        <a href="{{route('clientes.edit', ['cliente' => $cliente])}}" class="text-warning mr-2"><i class="fas fa-user-edit"></i></a>
                                        <form class="d-inline-block p-0" action="{{route('clientes.destroy', ['cliente' => $cliente])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger btn btn-link p-0 m-0"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum cliente foi encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                {{ $clientes->withQueryString()->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
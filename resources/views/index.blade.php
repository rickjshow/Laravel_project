@extends('layouts.app')

@section('title', 'Lista de Itens')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Lista de Itens</h3>
    <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Adicionar Item</a>
</div>

<div class="d-flex justify-content-end mb-3">
    <form action="{{ route('product.index') }}" method="GET" class="form-inline">
        <input type="text" name="search" class="form-control mr-2" placeholder="Buscar por nome, código ou descrição..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-secondary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Código</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->codigo }}</td>
            <td>{{ $product->descricao }}</td>
            <td>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('product.delete', $product->id) }}" class="delete-form" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

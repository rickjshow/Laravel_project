@extends('layouts.app')

@section('title', $product ? 'Editar Produto' : 'Criar Novo Produto')

@section('content')
    <h2>{{ $product ? 'Editar Produto' : 'Criar Novo Produto' }}</h2>
    <form action="{{ $product ? route('product.update', $product->id) : route('product.store') }}" method="POST">
        @csrf
        @if($product)
            @method('PUT') 
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Digite o nome do produto" required>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" class="form-control" id="code" name="codigo" value="{{ old('code', $product->codigo ?? '') }}" placeholder="Digite o código do produto" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="descricao" rows="3" placeholder="Digite a descrição do produto">{{ old('description', $product->descricao ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ $product ? 'Atualizar' : 'Salvar' }}</button>
    </form>
@endsection

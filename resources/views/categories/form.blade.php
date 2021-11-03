@extends('layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            {{isset($category) ? "Editar Categoria" : "Adicionar Categoria" }}
        </h1>
    </div>
    @include('errors', ['errors' => $errors])
    <form method="POST"
          action="{{ isset($category) ? route('categories.update', ['category' => $category]) : route('categories.store') }}">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="digite o nome da categoria"
                   value="{{ old('name', isset($category) ? $category->name : '')}}">
        </div>
        <div class="mb-3">
            <label for="categoryType" class="form-label">Tipo</label>
            <select class="form-control" id="categoryType" name="categoryType">
                <option value="0">--Selecione--</option>
                @foreach($categoryTypes as $type)
                    <option value="{{$type->id}}" @if(isset($category) && $type == $category->categoryType) selected @endif>{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
            <i data-feather="corner-down-left"></i> Retornar
        </a>
    </form>
@endsection

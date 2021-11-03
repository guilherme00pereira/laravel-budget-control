@extends('layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            {{isset($aggregator) ? "Editar Tag" : "Adicionar Tag" }}
        </h1>
    </div>
    @include('errors', ['errors' => $errors])
    <form method="POST" action="{{ isset($tag) ? route('tags.update', ['tag' => $tag]) : route('tags.store') }}">
        @csrf
        @if(isset($tag))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="digite o nome da conjunto"
                   value="{{ old('name', isset($tag) ? $tag->name : '')}}">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary btn-sm"><i data-feather="corner-down-left"></i> Retornar</a>
    </form>
@endsection

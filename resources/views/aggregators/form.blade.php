@extends('layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            {{isset($aggregator) ? "Editar Conjunto" : "Adicionar Conjunto" }}
        </h1>
    </div>
    @include('errors', ['errors' => $errors])
    <form method="POST" action="{{ isset($aggregator) ? route('aggregators.update', ['aggregator' => $aggregator]) : route('aggregators.store') }}">
        @csrf
        @if(isset($aggregator))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="digite o nome da conjunto"
                   value="{{ old('name', isset($aggregator) ? $aggregator->name : '')}}">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a href="{{ route('aggregators.index') }}" class="btn btn-secondary btn-sm"><i data-feather="corner-down-left"></i> Retornar</a>
    </form>
@endsection

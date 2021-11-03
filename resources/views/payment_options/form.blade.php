@extends('layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            {{isset($payment_option) ? "Editar Método de Pagamento" : "Adicionar Método de Pagamento" }}
        </h1>
    </div>
    @include('errors', ['errors' => $errors])
    <form method="POST"
          action="{{ isset($payment_option) ? route('payment_options.update', ['payment_option' => $payment_option]) : route('payment_options.store') }}">
        @csrf
        @if(isset($payment_option))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="digite o nome da categoria"
                   value="{{ old('name', isset($payment_option) ? $payment_option->name : '')}}">
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
        <a href="{{ route('payment_options.index') }}" class="btn btn-secondary btn-sm">
            <i data-feather="corner-down-left"></i> Retornar</a>
    </form>
@endsection

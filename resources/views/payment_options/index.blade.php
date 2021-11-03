@extends('layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Listar Métodos de Pagamento</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('payment_options.create') }}" class="btn btn-sm btn-primary"><i data-feather="plus"></i> Adicionar</a>
            </div>
        </div>
    </div>
    @include('message', ['message' => $message])
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <tbody>
            @foreach($payment_options as $payment_option)
                <tr>
                    <td>
                        <a href="{{ route('payment_options.show', ['payment_option' => $payment_option])}}">{{ $payment_option->name }}</a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('payment_options.edit', ['payment_option' => $payment_option])}}" class="btn btn-secondary btn-sm"><i data-feather="edit-3"></i></a>
                        <form method="post" action="/payment_options/{{ $payment_option->id }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($payment_option->name) }}?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

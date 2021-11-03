@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Listar Tipos de Recorrência</h1>
    
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
            @foreach($rtypes as $rtype)
            <tr>
                <td>{{ $rtype->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
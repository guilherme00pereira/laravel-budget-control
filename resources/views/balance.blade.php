@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('events.create') }}" class="btn btn-sm btn-primary"><i data-feather="plus"></i> Adicionar</a>
        </div>
      </div>

</div>
<div class="table-responsive py-3">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="bg-info">Saldo</th>
                <th class="bg-info">CCCC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>R$ @real($viewModel->balance())</td>
                <td>cccc</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row py-3">
    <div class="col-sm">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-success">Receita</th>
                    <th class="bg-success">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewModel->incomes as $income)
                    <tr>
                        <td>{{$income->category->name}}</td>
                        <td>
                            R$ @real($income->amount)
                            <span class="float-right">
                                <a href="{{ route('events.edit', ['event' => $income])}}" class="btn btn-light btn-sm"><i data-feather="edit-3"></i></a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        <span class="float-right">Total</span>
                    </td>
                    <td>
                        R$ @real($viewModel->totalIncomes())
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-danger">Despesas</th>
                    <th class="bg-danger">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewModel->fixed as $fix)
                    <tr>
                        <td>{{$fix->category->name}} - {{$fix->date}}</td>
                        <td>
                            R$ @real($fix->amount)
                            <span class="float-right">
                                <a href="{{ route('events.edit', ['event' => $fix])}}" class="btn btn-light btn-sm"><i data-feather="edit-3"></i></a>
                            </span>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        <span class="float-right">Total</span>
                    </td>
                    <td>
                        R$ @real($viewModel->totalFixed())
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

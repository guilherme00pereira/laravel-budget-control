@extends('layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        @include('buttons.add_event')

    </div>
    <div class="row">

        <h4 class="border-bottom">Previsão despesas por mês</h4>

        <div class="table-responsive col-md-12 pb-5">
            <table class="table table-bordered table-sm shadow">
                        <thead>
                        <tr class="table-primary">
                            <th>Mês</th>
                            <th>Fixas</th>
                            <th>Eventuais</th>
                            <th>Variáveis</th>
                            <th>Total</th>
                            <th>Receitas</th>
                            <th>Diferença</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($viewModel->getEvents() as $event)
                            <tr>
                                <td class="table-info">{{ $event['month'] }}</td>
                                <td>
                                    <a href="{{ route('events.details') }}?t=2&m={{ $event['month'] }}-2021">
                                        R$ @real($event['fixed'])
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('events.details') }}?t=4&m={{ $event['month'] }}">
                                        R$ @real($event['occasionally'])
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('events.details') }}?t=1&m={{ $event['month'] }}">
                                        R$ @real($event['variable'])
                                    </a>
                                </td>
                                <td class="fw-bold">R$ @real($event['total'])</td>
                                <td>
                                    <a href="{{ route('events.details') }}?t=3&m={{ $event['month'] }}">
                                    R$ @real($event['income'])
                                    </a>
                                </td>
                                <td class="fw-bold">R$ @real($event['diff'])</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
        </div>

    </div>

    <div class="row">
        <div class="table-responsive col-md-5 pb-5">
            <h4 class="border-bottom">Variações</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-dark">
                    <thead>
                    <tr>
                        <th>Fixas</th>
                        <th>Eventuais</th>
                        <th>Variáveis</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-primary">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h4 class="border-bottom">Despesas variáveis neste mês</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-dark">
                    <thead>
                    <tr>
                        <th>Total</th>
                        <th>Média Dia</th>
                        <th>Dias</th>
                        <th>Projeção</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-primary">
                        <td>R$ @real($viewModel->currentMonthVariableCost)</td>
                        <td>R$ @real($viewModel->currentMonthCostAverage)</td>
                        <td>{{ $viewModel->daysInMonth }}</td>
                        <td>R$ @real($viewModel->currentMonthProjection)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-responsive col-md-7 pb-5">
            <h4 class="border-bottom">Gasto por categoria no mês</h4>
            <div class="row pb-5">
                <canvas id="expensePerCategoryChart" width="1000" height="500"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        const ctxCategory = document.getElementById("expensePerCategoryChart");
        const expensePerCategoryChart = new Chart(ctxCategory, {
            type: 'bar',
            data: {
                labels: @php echo $viewModel->spendingPerCategory()->keys() @endphp,
                datasets: [{
                    label: 'Gasto por categoria',
                    data: @php echo $viewModel->spendingPerCategory()->values() @endphp,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                onClick: (event, activeElements) => {
                    //window.location.href = window.location.origin + "/categories/?n=" + (activeElements[0]);
                    console.log(event)
                }
            }
        });

    </script>
@endsection


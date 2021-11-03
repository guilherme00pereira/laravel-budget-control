@extends('layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $date }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button class="btn btn-sm btn-secondary datepicker">Trocar Mês</button>
            </div>
            @include('buttons.add_event')
        </div>
    </div>


    <div class="d-flex flex-row justify-content-center pb-5">
        <div class="btn-group">
            <a href="{{ route('events.details') }}?t=2" class="btn btn-outline-primary">
                <i data-feather="list"></i> ver fixas
            </a>
            <a href="{{ route('events.details') }}?t=4" class="btn btn-outline-primary">
                <i data-feather="list"></i> ver eventuais
            </a>
            <a href="{{ route('events.details') }}" class="btn btn-outline-primary">
                <i data-feather="list"></i> ver variáveis
            </a>
        </div>
    </div>

    <div class="row pb-5">
        <canvas id="dailyExpensesChart" width="1000" height="250"></canvas>
    </div>

@endsection


@section('scripts')
    <script>
        $('.datepicker').datepicker({
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months",
            language: 'pt-BR'
        }).on('changeDate', function(e){
            window.location.search = 'm=' + e.format();
        });

        const ctxDay = document.getElementById('dailyExpensesChart');
        const dailyExpensesChart = new Chart(ctxDay, {
            type: 'bar',
            data: {
                labels: @php echo $viewModel->spendingPerDay()->keys() @endphp,
                datasets: [{
                    label: 'Gasto por dia',
                    data: @php echo $viewModel->spendingPerDay()->values() @endphp,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                onClick: (event, activeElements) => {
                    window.location.href = window.location.origin + "/events/details?d=" + (activeElements[0]._index + 1);
                    //console.log(activeElements[0]);
                }
            }
        });


    </script>
@endsection

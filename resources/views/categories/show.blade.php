@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $viewModel->category->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        @include('buttons.previous_page')
    </div>
</div>

<div class="row pb-5">
    <canvas id="categoryPerMonth" width="1000" height="250"></canvas>
</div>

<div class="table-responsive">

    <table class="table table-striped table-bordered table-sm">
    @if($viewModel->isVariable() && $viewModel->getProjection() > 0)
        <tr>
            <td>
                <b>Total:</b> R$ @real($viewModel->getCurrentMonthSumAmount())
            </td>
            <td>
                <b>Previsão:</b> R$ @real($viewModel->getProjection())
            </td>
            <td>
                {{ $viewModel->getVariation() }}
            </td>
        </tr>
    @endif
    </table>

  <table class="table table-striped table-bordered table-sm">
      <thead>
        <tr>
            <th>Data</th>
            <th>Valor</th>
            <th>Descrição</th>
        </tr>
      </thead>
      <tbody>
          @foreach($viewModel->events as $event)
          <tr>
              <td>{{ $event->date }}</td>
              <td>
                  <a href="{{ route('events.edit', ['event' => $event])}}">
                      R$ @real($event->amount)
                  </a>
              </td>
              <td>{{ $event->description }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>

@endsection

@section('scripts')
    <script>
        const ctxDay = document.getElementById('categoryPerMonth');
        const categoryPerMonth = new Chart(ctxDay, {
            type: 'bar',
            data: {
                labels: @php echo $viewModel->getSpendingPerMonth()->keys() @endphp,
                datasets: [{
                    label: 'Gasto por dia',
                    data: @php echo $viewModel->getSpendingPerMonth()->values() @endphp,
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
                    window.location.href = window.location.origin + "/events/variable?d=" + (activeElements[0]._index + 1);
                }
            }
        });
    </script>
@endsection

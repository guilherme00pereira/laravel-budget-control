@extends('layout')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Despesas Recorrentes</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <tbody>
            @foreach($recurringEvents as $event)
                <tr>
                    <td>{{ $event->date }}</td>
                    <td>
                        <a href="{{ route('categories.show', ['category' => $event->category])}}">{{ $event->category->name }}</a>
                        @if(isset($event->description) && !empty($event->description))
                            <span class="text-muted">( {{$event->description}} )</span>
                        @endif
                    </td>
                    <td>{{ $event->pattern ? $event->pattern->num_of_occurrences : 'None' }}</td>
                    <td>R$ @real($event->amount)</td>
                    <td class="text-right">
                        <a href="{{ route('events.edit', ['event' => $event])}}" class="btn btn-secondary btn-sm"><i data-feather="edit-3"></i></a>
                        <form method="post" action="/events/{{ $event->id }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($event->name) }}?')" style="display: inline;">
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
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@endsection

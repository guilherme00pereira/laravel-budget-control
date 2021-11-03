@extends('layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $tag->name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm"><i data-feather="corner-down-left"></i> Retornar</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>R$ @real($total)</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tag->events->sortBy('date') as $event)
                <tr>
                    <td>{{ $event->date }}</td>
                    <td>
                        <span class="text-primary">{{ $event->category->name }}</span>
                        @if(isset($event->description) && !empty($event->description))
                            <span class="pl-3 text-muted font-italic">
                                {{$event->description}}
                            </span>
                        @endif
                    </td>
                    <td>R$ @real($event->amount)</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Nenhum evento relacionado a esta tag</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection

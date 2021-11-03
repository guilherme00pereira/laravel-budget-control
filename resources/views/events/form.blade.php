@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        {{isset($event) ? "Editar Evento" : "Adicionar Evento" }}
    </h1>
</div>
@include('errors', ['errors' => $errors])
<form method="POST" action="{{ isset($event) ? route('events.update', ['event' => $event]) : route('events.store') }}">
    @csrf
    @if(isset($event))
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nome" class="form-label">Data</label>
        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" id="date" name="date" autocomplete="off"
            value="{{ old('date', isset($event) ? $event->date : date('d/m/Y'))}}">
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Categoria</label>
        <select class="form-control" id="category" name="category">
            <option value="0">--Selecione--</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($event) && $category == $event->category) selected @endif>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="nome" class="form-label">Valor</label>
        <input type="text" class="form-control" id="amount" name="amount" placeholder="digite o valor"
            value="{{ old('amount', isset($event) ? $event->amount : '')}}">
    </div>
    <div class="mb-3">
        <label for="nome" class="form-label">Descrição</label>
        <textarea type="text" class="form-control" id="description" name="description" rows="3" >{{ old('description', isset($event) ? $event->description : '')}}</textarea>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_recurring" name="is_recurring" {{ isset($event) ?? ($event->is_recurring == '1' ? 'checked' : '')}}>
        <label class="form-check-label" for="is_recurring">É recorrente</label>
    </div>
    <div id="recurring_pattern_panel">
        <div class="mb-3">
            <label for="nome" class="form-label">Parcelas</label>
            <input type="text" class="form-control" id="num_of_occurrences" name="num_of_occurrences" placeholder="total de parcelas"
                value="{{ old('num_of_occurrences', isset($event->pattern) ? $event->pattern->num_of_occurrences : '')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary btn-sm"><i data-feather="corner-down-left"></i> Retornar</a>
</form>
@endsection

@section('scripts')
    <script>
        const is_recurring_checkbox = $('#is_recurring');
        function togglePatternPanel() {
           if(is_recurring_checkbox.is(':checked')){
               $('#recurring_pattern_panel').show();
           } else {
                $('#recurring_pattern_panel').hide();
           }
        }
        is_recurring_checkbox.change(function(){
            togglePatternPanel();
        })
        $(document).ready(function(){
            togglePatternPanel();
        });
        $('.datepicker').datepicker({
            language: 'pt-BR',
            todayHighlight: true,
        });
    </script>
@endsection

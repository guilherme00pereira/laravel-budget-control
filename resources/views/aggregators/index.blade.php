@extends('layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Listar Agregadores</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('aggregators.create') }}" class="btn btn-sm btn-primary"><i data-feather="plus"></i>
                    Adicionar</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tbody>
            @foreach($viewModel->listAggregators() as $aggregator)
                <tr>
                    <td>
                        Agregador: <b>{{ $aggregator->name }}</b>
                    </td>
                    <td class="text-right actions">
                        <a href="{{ route('aggregators.edit', ['aggregator' => $aggregator])}}"
                           class="btn btn-secondary btn-sm">
                            <i data-feather="edit-3"></i>
                        </a>
                        <form method="post" action="/aggregators/{{ $aggregator->id }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($aggregator->name) }}?')"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        Categorias:
                        @foreach($aggregator->categories as $category)
                            <span class="badge badge-light">
                                        {{$category->name}}
                                    </span>
                        @endforeach
                    </td>
                    <td class="text-right">
                        <div class="input-group input-group-sm col-md-6" style="float: right;">
                            <select name="dropdown-{{ $aggregator->id }}" id="dropdown-{{ $aggregator->id }}"
                                    class="custom-select">
                                @foreach($viewModel->listCategories() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                        data-category-add="{{ $aggregator->id }}">
                                    <i data-feather="plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $('[data-category-add]').click(function () {
            const agg = $(this).data('category-add');
            const cat = $("#dropdown-" + agg).val();
            $.post(
                "{{ route('aggregators.associate') }}",
                {
                    agg: agg,
                    ctg: cat,
                    _token: '{{csrf_token()}}'
                },
                function (data) {
                    window.location.reload();
                }
            );
        })
        /*
        $.post(
                "{{ route('aggregators.associate') }}",
                {
                    agg: $(this).data('add'),
                    ctg: $('#dropdown-' + $(this).data('add')).val(),
                    _token: '{{csrf_token()}}'
                }
            );
        */

    </script>
@endsection

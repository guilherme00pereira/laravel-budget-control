@extends('layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Listar Tags</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('tags.create') }}" class="btn btn-sm btn-primary"><i data-feather="plus"></i> Adicionar Tag</a>
            </div>
        </div>
    </div>
    @include('message', ['message' => $message])
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td>
                        <a href="{{ route('tags.show', ['tag' => $tag])}}">{{ $tag->name }}</a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('tags.edit', ['tag' => $tag])}}" class="btn btn-secondary btn-sm"><i data-feather="edit-3"></i></a>
                        <form method="post" action="/tags/{{ $tag->id }}"
                              onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($tag->name) }}?')" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i data-feather="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Não há tags cadastradas</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

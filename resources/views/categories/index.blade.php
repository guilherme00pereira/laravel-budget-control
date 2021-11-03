@extends('layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Listar Categorias</h1>
    @include('buttons.add_category')
</div>
@include('message', ['message' => $message])
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>
                  <a href="{{ route('categories.show', ['category' => $category])}}">{{ $category->name }}</a>
                </td>
                <td>
                    {{ $category->categoryType->name }}
                </td>
                <td class="text-right">
                    <a href="{{ route('categories.edit', ['category' => $category])}}" class="btn btn-secondary btn-sm"><i data-feather="edit-3"></i></a>
                    <form method="post" action="/categories/{{ $category->id }}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($category->name) }}?')" style="display: inline;">
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

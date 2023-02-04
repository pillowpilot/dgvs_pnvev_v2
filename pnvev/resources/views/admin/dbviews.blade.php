@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/user.css') }}">
@stop

@section('main')

<article>
    @if (isset($viewToDisplay))
    <span class="article-title">Modificando la vista: {{ $viewToDisplay->TABLE_NAME }}</span>
    <form class="article-content" action="{{ route('admin.dbviews.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id="view-editor-container" style="font-size:1rem;"></div>
        <input type="hidden" name="submissionType" value="save">
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
        </footer>
    </form>
    @else
    <span class="article-title">Seleccione una vista para modificarla</span>
    <form class="article-content" action="{{ route('admin.dbviews.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <select name="viewName" id="viewName">
                @foreach ($viewsAndDefinitions as $view)
                <option value="{{ $view->TABLE_NAME }}">{{ $view->TABLE_NAME }}</option>
                @endforeach
            </select>
        <input type="hidden" name="submissionType" value="lookup">
        <footer>
            <button class="admin-submit-button" type="submit">Modificar</button>
        </footer>
    </form>
    @endif
</article>

@stop

@section('scripts')
@if (isset($viewToDisplay))
<script>
    const VIEW_EDITOR_CONTAINER_ID = 'view-editor-container';
    const VIEW_DEFINITION = "{!! $viewToDisplay->VIEW_DEFINITION !!}";
</script>
<script src="{{ asset('js_v2/dbviews.js') }}" defer></script>
@endif
@stop

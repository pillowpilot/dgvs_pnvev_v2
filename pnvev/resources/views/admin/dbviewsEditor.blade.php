@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/user.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Modificando la vista: {{ $viewToDisplay->TABLE_NAME }}</span>
    <form class="article-content" action="{{ route('admin.dbviews.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id="view-editor-container" style="font-size:1rem;"></div>
        <footer>
            <button id="save-button" class="admin-submit-button" type="submit">Guardar</button>
        </footer>
    </form>
</article>

@stop

@section('scripts')
<script>
    const VIEW_EDITOR_CONTAINER_ID = 'view-editor-container';
    const VIEW_DEFINITION = "{!! $viewToDisplay->VIEW_DEFINITION !!}";
</script>
<script src="{{ asset('js_v2/dbviews.js') }}" defer></script>
@stop

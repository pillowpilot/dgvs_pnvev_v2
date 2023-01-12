@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/user.css') }}">
<link rel="stylesheet" data-name="vs/editor/editor.main" href="../js/vs/editor/editor.main.css"/>
@stop

@section('main')

<article>
    @if (isset($viewToDisplay))
    <span class="article-title">Modificando la vista: {{ $viewToDisplay->TABLE_NAME }}</span>
    <form class="article-content" action="{{ route('admin.dbviews.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id="view-editor-container"></div>
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
<script src="{{ asset('js/jquery/jquery-3.6.1.js') }}"></script>
<script src="{{ asset('js/jquery/select2/select2.full.js') }}"></script>
<script>
    var require = { paths: { vs: '../js/vs' } };
</script>
<script src="{{ asset('js/vs/loader.js') }}"></script>
<script src="{{ asset('js/vs/editor/editor.main.nls.js') }}"></script>
<script src="{{ asset('js/vs/editor/editor.main.js') }}"></script>
@if (isset($viewToDisplay))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        var editor = monaco.editor.create(document.getElementById('view-editor-container'), {
            value: "{!! $viewToDisplay->VIEW_DEFINITION !!}",
            language: 'sql',
	        theme: 'vs-dark',
            wordWrap: 'wordWrapColumn',
            wordWrapColumn: 120,
            wordWrapMinified: true,
            // try "same", "indent" or "none"
            wrappingIndent: 'same',
            autoIndent: true,
            formatOnPaste: true,
            formatOnType: true
        });
        
    });
</script>
@endif
@stop

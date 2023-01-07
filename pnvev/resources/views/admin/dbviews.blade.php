@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/dbviews.css') }}">
<link rel="stylesheet" data-name="vs/editor/editor.main" href="../js/vs/editor/editor.main.css"/>
@stop

@section('main')

<article>
    <main>
        <form action="{{ route('admin.dbviews.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
        
        @if (isset($viewToDisplay))

            <span>Modificando la vista: {{ $viewToDisplay->TABLE_NAME }}</span>
        
            <div id="container"></div>
            <input type="hidden" name="submissionType" value="save">
            <button type="submit">Guardar</button>
        
        @else

            <select name="viewName" id="viewName">
                @foreach ($viewsAndDefinitions as $view)
                <option value="{{ $view->TABLE_NAME }}">{{ $view->TABLE_NAME }}</option>
                @endforeach
            </select>
            
            <p>Seleccione una vista para modificarla</p>
            <input type="hidden" name="submissionType" value="lookup">
            <button type="submit">Modificar</button>
            
        @endif
        </form>
    </main>
    <footer>
        
    </footer>
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
        var editor = monaco.editor.create(document.getElementById('container'), {
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

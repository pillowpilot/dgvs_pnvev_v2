@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/admin.css') }}">
@stop

@section('main')
<article>
    <span class="article-title">Modificar contenido de la pagina principal</span>
    <form class="article-content" action="{{ route('admin.homePage.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <textarea name="value" id="value"></textarea>
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="submitStatus">
                @if(isset($submitStatus))
                Guardado correctamente.
                @endif
            </span>
        </footer>
    </form>
</article>
@stop

@section('scripts')
<script>
    const EDITOR_INITIAL_CONTENT = `{!! $editorInitialContent !!}`;
    const REST_HOMEPAGE_CONTENT_URL = "{{ route('rest.homePage') }}";
    const CONTENT_CSS = "{{ asset('css/editor.css') }}";
</script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js_v2/admin.js') }}" defer></script>
@stop

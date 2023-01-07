@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/home.css') }}">

<style>

</style>
@stop

@section('main')
<form action="{{ route('admin.homePage.store') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <textarea name="value" id="value"></textarea>
    <footer>
        <button type="submit">Guardar</button>
        <span id="submitStatus">
            @if(isset($submitStatus))
            Guardado correctamente.
            @endif
        </span>
    </footer>
</form>
@stop

@section('scripts')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
    const EDITOR_INITIAL_CONTENT = `{!! $editorInitialContent !!}`;
    const REST_HOMEPAGE_CONTENT_URL = "{{ route('rest.homePage') }}";
    document.addEventListener('DOMContentLoaded', () => {
    const editor = tinymce.init({
        selector: 'textarea#value',
        language: 'es_MX',
        content_css: "{{ asset('css/editor.css') }}",
        setup: (editor) => {
            editor.on('change', () => editor.save());
            editor.on('init', () => editor.setContent(EDITOR_INITIAL_CONTENT));
        },
        plugins: [
            'advlist', 'autolink', 'link', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
            'visualblocks', 'visualchars', 'fullscreen', 'insertdatetime',
            'media', 'table', 'template', 'help'
        ],
        });
    });
</script>
@stop

@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<style>
/* Main */
body>main {
    grid-area: main;
    display: grid;
    grid-template-areas:
        "left form right";
    grid-template-columns: 1fr 10fr 1fr;
    padding: 1rem 0;
}

body>main>form {
    grid-area: form;
    display: grid;
    grid-template-areas:
        "editor"
        "submit";
    grid-template-rows: 1fr 75px;
}

body>main form>footer {
    grid-area: submit;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

body>main form button[type="submit"] {
    padding: 0.5rem 1.5rem;
    background-color: #2071cc;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
}

.tox-tinymce {
    height: 100% !important;
}
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
    const REST_HOMEPAGE_CONTENT_URL = "{{ route('rest.homePage') }}";
    document.addEventListener('DOMContentLoaded', () => {
    const editor = tinymce.init({
        selector: 'textarea#value',
        language: 'es_MX',
        content_css: "{{ asset('css/editor.css') }}",
        setup: (editor) => {
            editor.on('change', () => editor.save());
            fetch(REST_HOMEPAGE_CONTENT_URL)
                .then(res => res.text())
                .then(data => {
                    editor.on('init', () => editor.setContent(data));
                });
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

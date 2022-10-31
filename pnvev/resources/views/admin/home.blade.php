<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header>
        <div><span>Página de Administración</span></div>
        <div>
            <ul>
                <a href="{{ route('auth.logout') }}">
                    <li>Salir</li>
                </a>
            </ul>
        </div>
    </header>
    <aside>
        <ul>
            <a href="{{ route('admin.homePage') }}">
                <li>Modificar Pagina Principal</li>
            </a>
            <a href="{{ route('home') }}">
                <li>Volver</li>
            </a>
        </ul>
        </ul>
    </aside>
    <main>
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
    </main>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        const REST_HOMEPAGE_CONTENT_URL = "{{ route('rest.homePage') }}";
        document.addEventListener('DOMContentLoaded', () => {
        const editor = tinymce.init({
            selector: 'textarea#value',
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
</body>
</html>
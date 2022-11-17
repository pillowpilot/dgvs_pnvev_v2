<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @section('stylesheets')
    @show
</head>
<body>
    <header>
        <div><span>Página de Administración</span></div>
        <div>
            <ul>
                <li>Bienvenido, {{ $user->name }}.</li>
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
            <a href="{{ route('admin.epiweek') }}">
                <li>Modificar Calendario</li>
            </a>
            <a href="{{ route('admin.user') }}">
                <li>Modificar Perfil</li>
            </a>
            <a href="{{ route('home') }}">
                <li>Volver</li>
            </a>
        </ul>
        </ul>
    </aside>

    <main>
        @section('main')
        @show
    </main>
    
    @section('scripts')
    @show
    
</body>
</html>
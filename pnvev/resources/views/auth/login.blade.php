<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <main>
        <header>
            <span>Ingrese sus datos</span>
        </header>
        @if (count($errors) > 0)
            <section>
                <strong>Errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
		@endif
        <section>
            <form action="{{ route('auth.loginform') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Ingrese su email">
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Ingrese su contraseña">
                <input class="submit" type="submit" value="Ingresar">
            </form>
        </section>
    </main>
</body>
</html>
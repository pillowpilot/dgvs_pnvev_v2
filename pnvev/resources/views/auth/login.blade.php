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
        <section>
            <form action="{{ route('auth.loginform') }}" method="POST">
                {!! csrf_field() !!}
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Ingrese su email">
                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Ingrese su contraseña">
                <div class="remember-me">
                    <input type="checkbox" name="remember"> Recordarme
                </div>
                <input class="submit" type="submit" value="Ingresar">
            </form>
        </section>
    </main>
</body>
</html>
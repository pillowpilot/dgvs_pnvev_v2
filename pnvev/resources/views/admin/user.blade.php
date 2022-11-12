@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<style>
/* Main */
body>main {
    /* grid-area: main; */
    display: grid;
    grid-template-areas:
        "left userform right"
        "left emailform right"
        "left passform right";
    grid-template-columns: 1fr 10fr 1fr;
    gap: 3rem;
    padding: 1rem 0;
}

body>main>article {
    display: grid;
    grid-template-areas:
        "title"
        "form";
    grid-template-rows: 2.5rem 1fr;
    gap: 1rem;
    max-height: 12rem;
}

body>main>article>span {
    font-size: 2rem;
    font-weight: 600;
    border-bottom: 1px solid #ccc;
}

body>main>article>form {
    display: grid;
    grid-template-areas:
        "main"
        "footer";
    grid-template-rows: 1fr 4rem;
    gap: 1rem;
    align-items: center;
}

body>main>article>form .inputs {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 0.5rem;
    align-items: center;
}

body>main>article>form>main>label {
    margin-right: 1rem;
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
</style>
@stop

@section('main')

<article style="grid-area: userform;">
    <span>Cambiar Nombre</span>
    <form action="{{ route('admin.user.storeName') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Nombre nuevo</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="{{ ($user->name === '')?'Nombre vacio':'' }}">
            </div>
        </main>
        <footer>
            <button type="submit">Guardar</button>
            <span class="submissionStatus" id="nameSubmitStatus">
                @if(isset($nameStatusMessageText))
                {{ $nameStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

<article style="grid-area: emailform;">
    <span>Cambiar Email</span>
    <form action="{{ route('admin.user.storeEmail') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="email">Email nuevo</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}">
            </div>
        </main>
        <footer>
            <button type="submit">Guardar</button>
            <span class="submissionStatus" id="emailSubmitStatus">
                @if(isset($emailStatusMessageText))
                {{ $emailStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

<article style="grid-area: passform;">
    <span>Cambiar Contraseña</span>
    <form action="{{ route('admin.user.storePassword') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="password_old">Contraseña actual</label>
                <input type="password" name="password_old" id="password_old">
                <label for="password_new">Contraseña nueva</label>
                <input type="password" name="password_new" id="password_new">
                <label for="password_new_confirmation">Repetir contraseña nueva</label>
                <input type="password" name="password_new_confirmation" id="password_new_confirmation">
            </div>
        </main>
        <footer>
            <button type="submit">Guardar</button>
            <span class="submissionStatus" id="passwordSubmitStatus">
                @if(isset($passwordStatusMessageText))
                {{ $passwordStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

@stop

@section('scripts')
@stop
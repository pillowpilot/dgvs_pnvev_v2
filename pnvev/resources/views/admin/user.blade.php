@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/user.css') }}">
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
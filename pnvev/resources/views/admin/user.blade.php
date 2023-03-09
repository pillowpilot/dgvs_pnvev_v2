@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/admin.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Cambiar Nombre</span>
    <form class="article-content" action="{{ route('admin.user.storeName') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Nombre nuevo</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="{{ ($user->name === '')?'Nombre vacio':'' }}">
            </div>
        </main>
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="nameSubmitStatus">
                @if($errors->has('name'))
                {{ $errors->first('name') }}
                @endif
                @if(isset($nameStatusMessageText))
                {{ $nameStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

<article>
    <span class="article-title">Cambiar Email</span>
    <form class="article-content" action="{{ route('admin.user.storeEmail') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="email">Email nuevo</label>
                <input type="text" name="email" id="email" value="{{ $user->email }}">
            </div>
        </main>
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="emailSubmitStatus">
                @if($errors->has('email'))
                {{ $errors->first('email') }}
                @endif
                @if(isset($emailStatusMessageText))
                {{ $emailStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

<article>
    <span class="article-title">Cambiar Contraseña</span>
    <form class="article-content" action="{{ route('admin.user.storePassword') }}" method="post">
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
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="passwordSubmitStatus">
                @if($errors->has('password_new'))
                {{ $errors->first('password_new') }}
                @endif
                @if($errors->has('password_old'))
                {{ $errors->first('password_old') }}
                @endif
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
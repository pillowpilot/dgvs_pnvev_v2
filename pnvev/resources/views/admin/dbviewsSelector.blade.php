@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/user.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Seleccione una vista para modificarla</span>
    <form class="article-content" action="{{ route('admin.dbviewsEditor') }}" method="get">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <select name="viewName" id="viewName">
                @foreach ($viewsAndDefinitions as $view)
                <option value="{{ $view->TABLE_NAME }}">{{ $view->TABLE_NAME }}</option>
                @endforeach
            </select>
        <footer>
            <button class="admin-submit-button" type="submit">Modificar</button>
        </footer>
    </form>
</article>

@stop

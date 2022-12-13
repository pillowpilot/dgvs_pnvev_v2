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
@stop

@section('scripts')
@stop

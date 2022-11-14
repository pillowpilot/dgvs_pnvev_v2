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
    <span>Seleccionar tabla</span>
    <form action="{{ route('admin.table.show') }}" method="post">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="table">Tabla</label>
                <select name="table" id="table">
                    @foreach($selectableTables as $tableKey => $tableName)
                        <option value="{{ $tableKey }}">{{ $tableName }}</option>
                    @endforeach
                </select>
                <!-- <input type="text" name="name" id="name" value="{{ $user->name }}" placeholder="{{ ($user->name === '')?'Nombre vacio':'' }}"> -->
            </div>
        </main>
        <footer>
            <button type="submit">Continuar</button>
            <span class="submissionStatus" id="tableSubmitStatus">
                @if(isset($tableStatusMessageText))
                {{ $tableStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

@stop

@section('scripts')
@stop
@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/tabulator/tabulator.min.css') }}">
<style>
/* Main */
body>main>article {
    display: grid;
    grid-template-areas:
        "left table right"
        "left footer right";
    grid-template-columns: 1fr 10fr 1fr;
    grid-template-rows: 1fr 3rem;
    gap: 1rem;
}

body>main>article>main {
    grid-area: table;
    padding-top: 2rem;
}

body>main>article>footer {
    grid-area: footer;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
}

body>main>article>footer button {
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

<article>
    <main>
        <div id="table-container"></div>
    </main>
    <footer>
        <button id="add-row">Agregar fila al final</button>
        <button id="reset-table">Restaurar</button>
        <form action="{{ route('admin.epiweek.store') }}" method="post" id="table-data-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button id="submit">Guardar</button>
            <span class="submissionStatus" id="submitStatus">
                @if(isset($statusMessageText))
                {{ $statusMessageText }}
                @endif
            </span>
        </form>
    </footer>
</article>

@stop

@section('scripts')
<script src="{{ asset('js/luxon/luxon.min.js') }}"></script>
<script src="{{ asset('js/tabulator/tabulator.min.js') }}"></script>
<script>
    const postURL = "{{ route('admin.epiweek') }}";
    const data = {!! $json !!};
    const columnsDefinitions = [
        {title: "SemanaEpidemiologica", field: "SemanaEpidemiologica", editor: "input"},
        {title: "Inicio", field: "Inicio", editor: "input"},
        {title: "Fin", field: "Fin", editor: "input"},
        // {title: "Inicio", field: "Inicio", editor:"date", editorParams:{
        //     // min:"01/01/2020", // the minimum allowed value for the date picker
        //     // max:"02/12/2030", // the maximum allowed value for the date picker
        //     format:"yyyy-mm-dd", // the format of the date value stored in the cell
        //     elementAttributes:{
        //         title:"slide bar to choose option" // custom tooltip
        //     }
        // }},
        // {title: "Fin", field: "Fin", editor:"date", editorParams:{
        //     // min:"01/01/2020", // the minimum allowed value for the date picker
        //     // max:"02/12/2030", // the maximum allowed value for the date picker
        //     format:"yyyy-mm-dd", // the format of the date value stored in the cell
        //     elementAttributes:{
        //         title:"slide bar to choose option" // custom tooltip
        //     }
        // }},
    ];
    document.addEventListener('DOMContentLoaded', () => {
        const elementId = '#table-container';
        const table = new Tabulator(elementId, {
            data: data,           //load row data from array
            layout: "fitColumns",      //fit columns to width of table
            responsiveLayout: "hide",  //hide columns that dont fit on the table
            addRowPos: "top",          //when adding a new row, add it to the top of the table
            history: true,             //allow undo and redo actions on the table
            pagination: "local",       //paginate the data
            paginationSize: 30,         //allow 7 rows per page of data
            paginationCounter: "rows", //display count of paginated rows in footer
            columns: columnsDefinitions,
            locale:"es-es",
            langs:{
                "es-es":{
                    "pagination":{
                        "page_size": "Tamaño de Página", //label for the page size select element
                        "page_title": "Mostrar Página", //tooltip text for the numeric page button
                        "first": "Primero", //text for the first page button
                        "first_title": "Primera página", //tooltip text for the first page button
                        "last": "Último",
                        "last_title": "Última página",
                        "prev": "Anterior",
                        "prev_title": "Página anterior",
                        "next": "Siguiente",
                        "next_title": "Página siguiente",
                        "all": "Todos",
                        "counter":{
                            "showing": "Mostrando",
                            "of": "de",
                            "rows": "filas",
                            "pages": "páginas",
                        }
                    },
                }
            },
        });
        document.getElementById('add-row').addEventListener('click', () => {
            table.addRow({}, false); // false => add row to the bottom
        });
        document.getElementById('reset-table').addEventListener('click', () => {
            table.setData(data);
        });
        document.getElementById('table-data-form').addEventListener('submit', () => {
            
            const data = table.getData();
            console.log('submitting', data);
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'data';
            input.value = JSON.stringify(data);
            document.getElementById('table-data-form').appendChild(input);
            
        });
    });
</script>
@stop

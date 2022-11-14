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
        <button>Guardar</button>
    </footer>
</article>

@stop

@section('scripts')
<script src="{{ asset('js/tabulator/tabulator.min.js') }}"></script>
<script>
    const data2 = {!! $json !!};
    document.addEventListener('DOMContentLoaded', () => {
        const elementId = '#table-container';
        const table = new Tabulator(elementId, {
            data: data2,           //load row data from array
            layout: "fitColumns",      //fit columns to width of table
            responsiveLayout: "hide",  //hide columns that dont fit on the table
            addRowPos: "top",          //when adding a new row, add it to the top of the table
            history: true,             //allow undo and redo actions on the table
            pagination: "local",       //paginate the data
            paginationSize: 30,         //allow 7 rows per page of data
            paginationCounter: "rows", //display count of paginated rows in footer
            columnDefaults:{
                tooltip:true,         //show tool tips on cells
            },
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
            autoColumns: true,
            autoColumnsDefinitions: (definitions) =>{
                //definitions - array of column definition objects

                definitions.forEach((column) => {
                    column.editor = "input"; // add input editor to every column
                });

                return definitions;
            },
        });
    });
</script>
@stop

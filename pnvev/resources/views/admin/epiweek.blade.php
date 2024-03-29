@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/tabulator/tabulator.min.css') }}">
<link rel="stylesheet" href="{{ asset('css_v2/admin.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Modificar semana epidemiológica</span>
    <main class="article-content">
        <div id="table-container"></div>
        <footer>
            <button class="admin-submit-button" id="add-row">Agregar fila al final</button>
            <button class="admin-submit-button" id="clear-table">Limpiar</button>
            <button class="admin-submit-button" id="reset-table">Restaurar</button>
            <label for="file-selector">Cargar desde archivo CVS:</label>
            <input type="file" id="file-selector" accept=".csv, .txt" >
            <form action="{{ route('admin.epiweek.store') }}" method="post" id="table-data-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="admin-submit-button" id="submit">Guardar</button>
                <span class="submissionStatus" id="submitStatus">
                    @if(isset($statusMessageText))
                    {{ $statusMessageText }}
                    @endif
                </span>
            </form>
        </footer>
    </main>
</article>

@stop

@section('scripts')
<script src="{{ asset('js/papaparse/papaparse.min.js') }}"></script>
<script src="{{ asset('js/luxon/luxon.min.js') }}"></script>
<script src="{{ asset('js/tabulator/tabulator.min.js') }}"></script>
<script>
    const postURL = "{{ route('admin.epiweek') }}";
    const data = {!! $json !!};
    const columnsDefinitions = [
        {title: "SemanaEpidemiologica", field: "SemanaEpidemiologica", editor: "input"},
        // {title: "Inicio", field: "Inicio", editor: "input"},
        // {title: "Fin", field: "Fin", editor: "input"},
        {title: "Inicio", field: "Inicio", editor:"date", editorParams:{
            // min:"01/01/2020", // the minimum allowed value for the date picker
            // max:"02/12/2030", // the maximum allowed value for the date picker
            format:"yyyy-MM-dd", // the format of the date value stored in the cell
            elementAttributes:{
                title:"slide bar to choose option" // custom tooltip
            }
        }},
        {title: "Fin", field: "Fin", editor:"date", editorParams:{
            // min:"01/01/2020", // the minimum allowed value for the date picker
            // max:"02/12/2030", // the maximum allowed value for the date picker
            format:"yyyy-MM-dd", // the format of the date value stored in the cell
            elementAttributes:{
                title:"slide bar to choose option" // custom tooltip
            }
        }},
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
        document.getElementById('clear-table').addEventListener('click', () => {
            table.clearData();
        });
        document.getElementById('reset-table').addEventListener('click', () => {
            table.clearData();
            table.setData(data);
        });
        document.getElementById('file-selector').addEventListener('change', (event) => {
            const file = event.target.files[0];
            Papa.parse(file, {
                header: true, // First line contains column names
                complete: function(results) {
                    table.setData(results.data);
                }
            });
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

@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/tabulator/tabulator.min.css') }}">
<link rel="stylesheet" href="{{ asset('css_v2/admin.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Modificar datos sobre enfermedades</span>
    <main class="article-content">
        <div id="table-container"></div>
        <footer>
            <button class="admin-submit-button" id="add-row">Agregar fila al final</button>
            <button class="admin-submit-button" id="clear-table">Limpiar</button>
            <button class="admin-submit-button" id="reset-table">Restaurar</button>
            <label for="file-selector">Cargar desde archivo CVS:</label>
            <input type="file" id="file-selector" accept=".csv, .txt" >
            <form action="{{ route('admin.diseases.store') }}" method="post" id="table-data-form">
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
<script>
    const postURL = "{{ route('admin.epiweek') }}";
    const data = {!! $json !!};
    const columnsDefinitions = [
        {title: "Id", field: "id", editor: "input"},
        {title: "Id Padre", field: "parent_id", editor: "input"},
        {title: "Nombre", field: "name", editor: "input"},
        {title: "Nivel", field: "level", editor: "input"},
        {title: "Orden", field: "order", editor: "input"},
        {title: "Descripcion Caso", field: "case_description", editor: "input"},
        {title: "Titulo Tendencias", field: "tendencies_title", editor: "input"},
        {title: "Titulo Tendencias Hijos", field: "children_tendencies_title", editor: "input"},
        {title: "Titulo Distribucion", field: "distribution_title", editor: "input"},
        {title: "Titulo Mapa Departamentos", field: "regions_heatmap_title", editor: "input"},
        {title: "Titulo Mapa Distritos", field: "districts_heatmap_title", editor: "input"},
    ];
    
</script>
<script src="{{ asset('js_v2/diseases.js') }}" defer></script>
@stop

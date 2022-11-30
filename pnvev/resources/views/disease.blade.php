@extends('layouts.master', ['activeDisease' => $activeDisease])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/disease-content.css') }}">
@stop

@section('scripts')
<script>
    const EPIWEEK = {{ $epiweek }};
    const DISEASE_ID = {{ $diseaseId }};
    const DISEASEFULLNAME = '{{ $diseaseFullName }}';
    const DISEASETITLE = DISEASEFULLNAME;
    const DISEASE_CHILDREN = {!! $diseaseChildren->toJson() !!};
    const DISEASE_CASE_DESCRIPTION = '{{ $diseaseCaseDescription }}';
    const ROOT_URL = '{{ route('home') }}';
    const DATA_PY_TOPO_JSON_URL = "{{ asset('data/py-all.topo.json') }}";
    const tendenciaDataURL = '';
    const barHorizontalDataURL = '';
    console.log('DISEASE_CHILDREN');
    console.table(DISEASE_CHILDREN);
</script>
<script src="{{ asset('js/jquery/jquery-3.6.1.js') }}"></script>
<script src="{{ asset('js/jquery/select2/select2.full.js') }}"></script>
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/accessibility.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/map.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/exporting.js') }}"></script>
<script src="{{ asset('js/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('js/geometric/geometric.min.js') }}"></script>
<script src="{{ asset('js/charts/initialization.js') }}" type="module"></script>
<script src="{{ asset('js/utils.js') }}" type="module"></script>
<script src="{{ asset('js/charts/tendencies.js') }}" type="module"></script>
<script src="{{ asset('js/chartsOrchestrator.js') }}" type="module"></script>
@stop

@section('main')

<!-- <nav class="sidebar">
    <ul>
        <li><a href="#tendencies">Gráfico de Tendencias</a></li>
        <li><a href="#bars">Barras horizontales</a></li>
        <li><a href="#heatmap">Mapa de Calor</a></li>
    </ul>
</nav> -->

<main>
    <div class="article-wrapper">
        <article class="tendencies rounded-corners">
            <header><a id="tendencies">Gráfico de tendencia en el tiempo de {{ $diseaseCaseDescription }} de {{ $diseaseFullName }}, por Semana Epidemiológica</a></header>
            <section class="toolbox">
                <section class="filters rounded-corners">
                    <div class="filter">
                        <select name="tendencias-initialYear">
                        </select>
                    </div>
                    <div class="filter">
                        <select  name="tendencias-finalYear">
                        </select>
                    </div>
                    <div class="submit">
                        <button type="button" name="tendencias-submit">Actualizar</button>
                    </div>
                </section>
                <section class="export rounded-corners">
                    <button type="button" name="export-pdf">PDF</button>
                    <button type="button" name="export-svg">SVG</button>
                    <button type="button" name="export-xls">XLS</button>
                    <button type="button" name="export-csv">CSV</button>
                </section>
            </section>
            <section class="totals rounded-corners">
                <span>La cantidad total de casos de <span id="total-disease"></span> es: <span id="total-total"></span>.</span>
            </section>
            <section id="tendencia" class="graphics rounded-corners"></section>
            <footer>
                <span>Las gráficas son interactivas. Mueva el cursor sobre ellas o haga click sobre las leyendas para filtrar la vizualización.</span>
            </footer>
        </article>
    </div>
    @if(count($diseaseChildren) > 0)
    <div class="article-wrapper">
        <article class="tendencies-children rounded-corners">
            <header><a id="tendencies">Gráfico de tendencia en el tiempo de {{ $diseaseCaseDescription }} de {{ $diseaseFullName }}, por Semana Epidemiológica, por Enfermedades Constituyentes</a></header>
            <section class="toolbox">
                <section class="filters rounded-corners">
                    <div class="filter">
                        <select name="tendencias-2-year">
                        </select>
                    </div>
                    <div class="submit">
                        <button type="button" name="tendencias-submit">Actualizar</button>
                    </div>
                </section>
                <section class="export rounded-corners">
                    <button type="button" name="export-pdf">PDF</button>
                    <button type="button" name="export-svg">SVG</button>
                    <button type="button" name="export-xls">XLS</button>
                    <button type="button" name="export-csv">CSV</button>
                </section>
            </section>
            <section id="tendencia-hijos" class="graphics rounded-corners"></section>
            <footer>
                <span>Las gráficas son interactivas. Mueva el cursor sobre ellas o haga click sobre las leyendas para filtrar la vizualización.</span>
            </footer>
        </article>
    </div>
    @endif
    <div class="article-wrapper">
        <article class="horizontalBar rounded-corners">
            <header><a id="bars">Distribución de {{ $diseaseCaseDescription }} de {{ $diseaseFullName }}, por rango de edad y sexo</a></header>
            <section class="toolbox">
                <section class="filters rounded-corners">
                    <div class="filter">
                        <select name="horizontalBar-year">
                        </select>
                    </div>
                    <div class="submit">
                        <button type="button" name="horizontalBar-submit">Actualizar</button>
                    </div>
                </section>
                <section class="export rounded-corners">
                    <button type="button" name="export-pdf">PDF</button>
                    <button type="button" name="export-svg">SVG</button>
                    <button type="button" name="export-xls">XLS</button>
                    <button type="button" name="export-csv">CSV</button>
                </section>
            </section>
            <section id="barHorizontal" class="graphics rounded-corners"></section>
            <footer>
                <span>Las gráficas son interactivas. Mueva el cursor sobre ellas o haga click sobre las leyendas para filtrar la vizualización.</span>
            </footer>
        </article>
    </div>
    <div class="article-wrapper">
        <article class="heatmap rounded-corners">
            <header><a id="heatmap">Distribución de {{ $diseaseCaseDescription }} de {{ $diseaseFullName }}, según departamentos de residencia en Paraguay, por año</a></header>
            <section class="toolbox rounded-corners">
                <section class="filters rounded-corners"></section>
                <section class="export rounded-corners">
                        <button type="button" name="export-pdf">PDF</button>
                        <button type="button" name="export-svg">SVG</button>
                        <button type="button" name="export-xls">XLS</button>
                        <button type="button" name="export-csv">CSV</button>
                </section>
            </section>
            <section id="map-regions" class="map-graphics rounded-corners"></section>
            <footer>
                <span>Las gráficas son interactivas. Mueva el cursor sobre ellas o haga click sobre las leyendas para filtrar la vizualización.</span>
            </footer>
        </article>
    </div>
    <div class="article-wrapper">
        <article class="heatmap rounded-corners">
            <header><a id="heatmap">Distribución de {{ $diseaseCaseDescription }} de {{ $diseaseFullName }}, según distritos de residencia en Paraguay, por año</a></header>
            <section class="toolbox rounded-corners">
                <section class="filters rounded-corners"></section>
                <section class="export rounded-corners">
                        <button type="button" name="export-pdf">PDF</button>
                        <button type="button" name="export-svg">SVG</button>
                        <button type="button" name="export-xls">XLS</button>
                        <button type="button" name="export-csv">CSV</button>
                </section>
            </section>
            <section id="map-districts" class="map-graphics rounded-corners"></section>
            <footer>
                <span>Las gráficas son interactivas. Mueva el cursor sobre ellas o haga click sobre las leyendas para filtrar la vizualización.</span>
            </footer>
        </article>
    </div>
</main>
@stop
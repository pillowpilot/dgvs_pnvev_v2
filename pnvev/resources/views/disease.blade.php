@extends('layouts.master', ['orphanDiseases' => $orphanDiseases, 'diseaseFamilies' => $diseaseFamilies])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/disease-content.css') }}">
@stop

@section('scripts')
<script>
    const DISEASE_ID = {{ $diseaseId }};
    const DISEASEFULLNAME = '{{ $diseaseFullName }}';
    const DISEASETITLE = DISEASEFULLNAME;
    const tendenciaDataURL = '';
    const barHorizontalDataURL = '';
</script>
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/accessibility.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/map.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/exporting.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="{{ asset('js/charts/initialization.js') }}" type="module"></script>
<script src="{{ asset('js/utils.js') }}" type="module"></script>
<script src="{{ asset('js/charts/tendencies.js') }}" type="module"></script>
<script src="{{ asset('js/chartsOrchestrator.js') }}" type="module"></script>
@stop

@section('main')
<main>
    <div class="article-wrapper">
        <article class="canal-endemico">
            <header>Gráfico de tendencia en el tiempo por Semana Epidemiológica</header>
            <section class="filters">
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
            <section id="tendencia" class="graphics"></section>
            <footer>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                <span><strong>Fuente:</strong>DGVS (yyyy/mm/dd)</span>
            </footer>
        </article>
    </div>
    <div class="article-wrapper">
        <article class="tendencias">
            <header>Gráfico de distribución anual por Rango de Edad y Sexo</header>
            <section class="filters">
                <div class="filter">
                    <select name="horizontalBar-year">
                    </select>
                </div>
                <div class="submit">
                    <button type="button" name="horizontalBar-submit">Actualizar</button>
                </div>
            </section>
            <section id="barHorizontal" class="graphics"></section>
            <footer>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                <span><strong>Fuente:</strong>DGVS (yyyy/mm/dd)</span>
            </footer>
        </article>
    </div>
    <div class="article-wrapper">
        <article class="casos">
            <header>Mapa de Calor</header>
            <section class="filters"></section>
            <section id="map" class="map-graphics"></section>
            <footer>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                <span><strong>Fuente:</strong>DGVS (yyyy/mm/dd)</span>
            </footer>
        </article>
    </div>
</main>
@stop
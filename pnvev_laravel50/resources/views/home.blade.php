@extends('layouts.master', ['active' => 'home'])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('scripts')
<script>
    const ROOT_URL = '{{ route('home') }}';
</script>
<script src="{{ asset('js/jquery/jquery-3.6.1.js') }}"></script>
<script src="{{ asset('js/jquery/select2/select2.full.js') }}"></script>
<script src="{{ asset('js/jquery/pivottable/pivot.js') }}"></script>
<script src="{{ asset('js/jquery/pivottable/pivot.es.js') }}"></script>
<script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/accessibility.js') }}"></script>
<script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/map.js') }}"></script>
<script src="{{ asset('js/highcharts/maps/modules/exporting.js') }}"></script>
<script src="{{ asset('js/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('js/charts/initialization.js') }}" type="module"></script>
<script src="{{ asset('js/utils.js') }}" type="module"></script>
<script src="{{ asset('js/charts/tendencies.js') }}" type="module"></script>
<script src="{{ asset('js/home.js') }}" type="module" defer></script>
@stop

@section('main')
<main>
    <article>
        @if(isset($content))
        {!! $content !!}
        @else
        <section class="text-intro">
            <header>
                <h1>Programa Nacional de Enfermedades Vectoriales</h1>
            </header>
            <section>
                <p>
                    El PNVEV fue creado por Resolución SG N° 483/2018 por medio de la cual se aprueba la Misión y la Visión y se actualiza el organigrama genérico de la Dirección General de Vigilancia de la Salud. En la misma, la Dirección de Vigilancia de Enfermedades transmitidas por Vectores pasa a denominarse “Programa Nacional de Enfermedades Vectoriales”, y depende de la Dirección de Vigilancia de Enfermedades Transmisibles.
                </p>
                <p>
                    Para mas información en referencia a las enfermedades vectoriales, bajo vigilancia del PNVEV, haga click <a href="https://dgvs.mspbs.gov.py/webdgvs/views/paginas/divet.html">aquí</a>.
                </p>
            </section>
        </section>
        @endif
    </article>
</main>
@stop
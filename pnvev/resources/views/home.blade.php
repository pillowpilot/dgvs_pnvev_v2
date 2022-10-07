@extends('layouts.master', ['active' => 'home'])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

@section('scripts')
<script>
    const ROOT_URL = '{{ route('home') }}';
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
<script src="{{ asset('js/home.js') }}" type="module" defer></script>
@stop

@section('main')
<main>
    <article>
        <section class="text-intro">
            <header>
                <h1>Leishmaniasis</h1>
            </header>
            <section>
                <header>
                    <h2>Key Facts</h2>
                </header>
                <ul>
                    <li>
                        <p>
                            There are 3 main forms of leishmaniases – visceral (also known as kala-azar, which is and
                            the
                            most serious form of the disease), cutaneous (the most common), and mucocutaneous.
                        </p>
                    </li>
                    <li>
                        <p>
                            Leishmaniasis is caused by protozoan parasites which are transmitted by the bite of infected
                            female phlebotomine sandflies.
                        </p>
                    </li>
                    <li>
                        <p>
                            The disease affects some of the poorest people and is associated with malnutrition,
                            population
                            displacement, poor housing, a weak immune system and lack of financial resources.</p>
                    </li>
                    <li>
                        <p>Leishmaniasis is also linked to environmental changes such as deforestation, building of
                            dams,
                            irrigation schemes and urbanization.
                        </p>
                    </li>
                    <li>
                        <p>An estimated 700 000 to 1 million new cases occur annually.</p>
                    </li>
                    <li>
                        <p>
                            Only a small fraction of those infected by parasites causing leishmaniasis will eventually
                            develop the disease.
                        </p>
                    </li>
                </ul>
            </section>
            <section>
                <header>
                    <h2>Transmission</h2>
                </header>
                <p>
                    <em>Leishmania</em> parasites are transmitted through the bites of infected female phlebotomine
                    sandflies,
                    which feed on blood to produce eggs. The epidemiology of leishmaniasis depends on the
                    characteristics of the parasite and sandfly species, the local ecological characteristics of the
                    transmission sites, current and past exposure of the human population to the parasite, and human
                    behaviour. Some 70 animal species, including humans, have been found as natural reservoir hosts of
                    <em>Leishmania</em> parasites.
                </p>
            </section>
        </section>
        <section id="graphics">
        </section>
    </article>
</main>
@stop
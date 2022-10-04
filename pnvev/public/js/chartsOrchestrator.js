import { chartGenerator as tendenciesChartGenerator } from './charts/tendencies.js';
import { chartGenerator as horizontalBarChartGenerator } from './charts/horizontalBars.js';

const initializeSelect = (selectName, filterName, fieldName, placeholderText) => {
    $(`select[name="${selectName}"]`).select2({
        ajax: {
            url: `${ROOT_URL}/api/v1/values/${filterName}`,
            delay: 250,
            cache: true,
            dataType: 'json',
            data: (params) => ({
                TipoEnfermedad: DISEASEFULLNAME
            }),
            processResults: (data, page) => {
                const results = data.map((o, i) => ({ id: i, text: o[fieldName] }));
                return { results: results };
            }
        },
        placeholder: placeholderText,
    });
};

document.addEventListener('DOMContentLoaded', function () {
    const horizontalChartContainerId = 'barHorizontal';

    $(`select[name="horizontalBar-year"]`).select2({
        ajax: {
            url: `${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`,
            dataType: 'json',
            processResults: (data, page) => {

                const results = data.map((o, i) => ({ id: i, text: o['Year'] }));
                return { results: results };
            }
        },
        placeholder: 'Año',
    });

    const horizontalChart = horizontalBarChartGenerator(horizontalChartContainerId, DISEASETITLE);

    $('button[name="horizontalBar-submit"]').on('click', (e) => {
        const filters = {
            InitialYear: $('select[name="horizontalBar-year"]').find(':selected').val(),
        };
        // Check if any is undefined
        console.log(filters);

        let GETParams = new URLSearchParams({
            TipoEnfermedad: DISEASEFULLNAME,
            InitialYear: $('select[name="horizontalBar-year"]').find(':selected').text(),
            FinalYear: $('select[name="horizontalBar-year"]').find(':selected').text(),
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });
        GETParams.append('groupBy[]', 'Sexo');
        GETParams.append('groupBy[]', 'GrupoEtareo');

        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?` + GETParams)
            .then(res => res.json())
            .then(data => {
                console.log(data);

                const categories = _(data).map('GrupoEtareo').uniq().value();
                console.log(categories);
                console.log(horizontalChart);

                const x = _(data).groupBy('Year').mapValues((yearData, year) => _(yearData).groupBy('Sexo').mapValues(v => v.map(o => [o.GrupoEtareo, o.Total])).value()).value();
                console.table(x);

                while (horizontalChart.series.length) {
                    horizontalChart.series[0].remove(false); // false = do not redraw
                }
                horizontalChart.redraw();

                _(x[$('select[name="horizontalBar-year"]').find(':selected').text()]).mapValues((genderData, gender) => {
                    console.log(gender, genderData);
                    horizontalChart.addSeries({
                        name: gender,
                        data: genderData,
                    });
                }).value();

            });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const tendenciesChartContainerId = 'tendencia';

    initializeSelect('tendencias-initialYear', 'Year', 'Year', 'Año Inicial');
    initializeSelect('tendencias-finalYear', 'Year', 'Year', 'Año Final');

    const tendenciesChart = tendenciesChartGenerator(tendenciesChartContainerId, DISEASETITLE);

    $('button[name="tendencias-submit"]').on('click', (e) => {
        const filters = {
            InitialYear: $('select[name="tendencias-initialYear"]').find(':selected').val(),
            FinalYear: $('select[name="tendencias-finalYear"]').find(':selected').val(),
        };
        // Check if any is undefined
        console.log(filters);

        let GETParams = new URLSearchParams({
            TipoEnfermedad: DISEASEFULLNAME,
            InitialYear: $('select[name="tendencias-initialYear"]').find(':selected').text(),
            FinalYear: $('select[name="tendencias-finalYear"]').find(':selected').text(),
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });
        GETParams.append('groupBy[]', 'SemanaEpidemiologica');


        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?` + GETParams)
            .then(res => res.json())
            .then(data => {
                const groupedData =
                    _(data)
                        .groupBy('Year')
                        .mapValues(
                            yearData => _(yearData)
                                .map(({ SemanaEpidemiologica, Total }) => [SemanaEpidemiologica, Total]).value()
                        )
                        .value();

                while (tendenciesChart.series.length) {
                    tendenciesChart.series[0].remove(false); // false = do not redraw
                }
                tendenciesChart.redraw();

                _(groupedData).mapValues((yearData, year) =>
                    tendenciesChart.addSeries({
                        name: year,
                        data: yearData,
                    })
                ).value();
            });
    });



    fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?`)
        .then(res => res.json())
        .then(data => {
            // console.log('Here!');
            // console.log(data);

            const structuredData =
                _(data)
                    .groupBy(o => (new Date(o.date)).getFullYear())
                    .mapValues(yearData =>
                        _(yearData)
                            .groupBy(o => o.epiweek)
                            .mapValues(l => l.length)
                            .value())
                    .value()

            // console.log(
            //     'struct data',
            //     structuredData
            // );

            const seriesData = _(structuredData)
                .mapValues((yearData) =>
                    _(yearData)
                        .reduce((acc, y, x) => {
                            acc.push([x, y]);
                            return acc;
                        }, [])
                )
                .value();
            // console.log(seriesData);
            const series = _(seriesData).reduce((acc, data_, year) => {
                acc.push({ name: year, data: data_ })
                return acc;
            }, []);

            // console.log(series);

            // chart2.addSeries(series);
        });

    const data = [
        ['py-ag', 10], ['py-bq', 11], ['py-cn', 12], ['py-ph', 13],
        ['py-cr', 14], ['py-sp', 15], ['py-ce', 16], ['py-mi', 17],
        ['py-ne', 18], ['py-gu', 19], ['py-pg', 20], ['py-am', 21],
        ['py-aa', 22], ['py-cg', 23], ['py-cz', 24], ['py-cy', 25],
        ['py-it', 26], ['py-as', 27]
    ];

    fetch(DATA_PY_TOPO_JSON_URL)
        .then(res => res.json())
        .then(geojson => {
            Highcharts.mapChart('map', {
                chart: {
                    map: geojson
                },

                title: {
                    text: 'Demo de Mapa temático proporcional/calor (Columna 1 de la tabla de requerimientos)',
                },

                subtitle: {
                    text: '<strong>Paraguay</strong>'
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0
                },

                series: [{
                    data: data,
                    name: 'Datos aleatorios!',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]
            });
        });
});

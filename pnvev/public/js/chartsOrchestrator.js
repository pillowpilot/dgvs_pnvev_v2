import { TendencyChart } from './charts/tendencies.js';
import { HorizontalBarsChart } from './charts/horizontalBars.js';

// Utilities
const initializeSelect = (selectName, filterName, fieldName, placeholderText) => {
    $(`select[name="${selectName}"]`).select2({
        ajax: {
            url: `${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`,
            dataType: 'json',
            processResults: (data, page) => {

                const results = data.map((o, i) => ({ id: i, text: o[fieldName] }));
                return { results: results };
            }
        },
        placeholder: placeholderText,
    });
};

// Load tendencies
document.addEventListener('DOMContentLoaded', () => {
    // initializeSelect('tendencias-initialYear', 'Year', 'Year', 'Año Inicial');
    // initializeSelect('tendencias-finalYear', 'Year', 'Year', 'Año Final');

    const tendenciesChart_v2 = new TendencyChart('tendencia');
    tendenciesChart_v2.setTitleText(`Casos Confirmados de ${DISEASETITLE}`);
    tendenciesChart_v2.setSubtitleText(`por semana epidemiológica de notificación por año`);
    tendenciesChart_v2.setXAxisText(`Semanas Epidemiológicas`);
    tendenciesChart_v2.setYAxisText(`N&deg; de Casos`);
    tendenciesChart_v2.setCreditsText(`Programa Nacional de Enfermedades Vectoriales - PNVEV/DIVET - DGVS. Actualizado a la fecha.`);
    tendenciesChart_v2.bindExportingButton(document.querySelector('article[class="tendencies"] button[name="export-pdf"]'), 'application/pdf');
    tendenciesChart_v2.bindExportingButton(document.querySelector('article[class="tendencies"] button[name="export-svg"]'), 'image/svg+xml');
    // tendenciesChart_v2.bindExportingButton(document.querySelector('article[class="tendencies"] button[name="export-xlsx"]'), '');
    tendenciesChart_v2.draw();
    const tendenciesChart = tendenciesChart_v2.getChartObject();

    let GETParams = new URLSearchParams({
        TipoEnfermedad: DISEASEFULLNAME,
        InitialYear: '2018',
        FinalYear: '2022', //$('select[name="tendencias-finalYear"]').find(':selected').text(),
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
                            .map(({ SemanaEpidemiologica, Total }) => ({x: parseInt(SemanaEpidemiologica), y: Total})).value()
                    )
                    .mapValues(
                        yearData => _(yearData).sortBy('x').value()
                    )
                    .value();

            tendenciesChart_v2.removeAllSeries();

            _(groupedData).mapValues((yearData, year) =>
                tendenciesChart_v2.addSeries(yearData, year)
            ).value();
        });
});

// Load horizontal
document.addEventListener('DOMContentLoaded', () => {
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

    const horizontalChart_v2 = new HorizontalBarsChart('barHorizontal');
    horizontalChart_v2.setTitleText(`Distribución de casos confirmados de ${DISEASETITLE}`);
    horizontalChart_v2.setSubtitleText(`por rango de edad y sexo`);
    horizontalChart_v2.setYAxisText(`Cantidad de Casos`);
    horizontalChart_v2.setCreditsText(`Programa Nacional de Enfermedades Vectoriales - PNVEV/DIVET - DGVS. Actualizado a la fecha.`);
    horizontalChart_v2.bindExportingButton(document.querySelector('article[class="horizontalBar"] button[name="export-pdf"]'), 'application/pdf');
    horizontalChart_v2.bindExportingButton(document.querySelector('article[class="horizontalBar"] button[name="export-svg"]'), 'image/svg+xml');
    horizontalChart_v2.draw();
    const horizontalChart = horizontalChart_v2.getChartObject();

    $('button[name="horizontalBar-submit"]').on('click', (e) => {
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

                horizontalChart_v2.removeAllSeries();

                _(x[$('select[name="horizontalBar-year"]').find(':selected').text()]).mapValues((genderData, gender) => {
                    horizontalChart_v2.addSeries(genderData, gender);
                }).value();

            });
    });
});

// Load map
document.addEventListener('DOMContentLoaded', function () {
    let GETParams = new URLSearchParams({
        TipoEnfermedad: DISEASEFULLNAME,
        InitialYear: '2022',
        FinalYear: '2022',
        InitialEpiweek: 1,
        FinalEpiweek: 53,
    });
    GETParams.append('groupBy[]', 'RegionAdministrativaId');

    const regions_pr = fetch(`${ROOT_URL}/api/v1/regions`).then(res => res.json());
    const topo_pr = fetch(DATA_PY_TOPO_JSON_URL).then(res => res.json());
    const map_pr = fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?` + GETParams).then(res => res.json());

    Promise.all([regions_pr, topo_pr, map_pr])
        .then(([regions_data, topo_data, map_data]) => {
            const regionIdToMapCode = (id) => regions_data.filter(o => o.id === id)[0].map_code;
            const data2 = map_data.map(o => [regionIdToMapCode(o.RegionAdministrativaId), parseInt(o.Total)]);

            console.table(regions_data);
            console.table(topo_data);
            console.table(map_data);
            console.table(data2);

            Highcharts.mapChart('map', {
                chart: {
                    map: topo_data
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
                    minColor: '#e0f7fa', //'#e3973b',
                    maxColor: '#26a69a', //'#cc332b',//
                    type: 'linear',
                    min: 0
                },

                credits: {
                    text: `Fuente: PNVEV - DGVS | Según los datos de la fecha: dd/mm/yyyy`,
                    position: {
                        align: 'right',
                    },
                    style: {
                        fontSize: '11px',
                    },
                },

                series: [{
                    data: data2,
                    name: `${DISEASEFULLNAME}`,
                    states: {
                        hover: {
                            color: '#6d9eeb'
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

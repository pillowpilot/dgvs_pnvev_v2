import { chartGenerator as tendenciesChartGenerator } from './charts/tendencies.js';

document.addEventListener('DOMContentLoaded', () => {
    const DISEASETITLE = 'Leishmaniasis Mucosa';
    const DISEASEFULLNAME = 'Leishmaniasis Mucosa';
    const DISEASE_ID = 1;
    const tendenciesChartContainerId = 'graphics';
    const tendenciesChart = tendenciesChartGenerator(tendenciesChartContainerId, DISEASETITLE);

    let GETParams = new URLSearchParams({
        TipoEnfermedad: DISEASEFULLNAME,
        InitialYear: '2022',
        FinalYear: '2022',
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
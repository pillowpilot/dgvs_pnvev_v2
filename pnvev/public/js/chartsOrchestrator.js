import { TendencyChart } from './charts/tendencies.js';
import { HorizontalBarsChart } from './charts/horizontalBars.js';
import { Choropleth } from './charts/map.js';

const currentDate = (new Date()).toLocaleDateString('es-PY', {day: 'numeric', month: 'long', year: 'numeric'});

class YearSelect {
    constructor(url) {
        this.url = url;
    }

    setPlaceholder(placeholder) {
        this.placeholder = placeholder;
    }

    async bind(jQueryElement) {
        this.jQueryElement = jQueryElement;
            
        jQueryElement.select2({
            ajax: {
                url: this.url,
                dataType: 'json',
                processResults: (data, page) => {
                    const results = data.map((o, i) => ({ id: i, text: o.Year }));
                    return { results: results };
                },
            },
            placeholder: {
                // id: 1,
                text: this.placeholder,
            },
            language: {
                noResults: () => 'Sin resultados',
            },
        });
    }

    getSelectedYear() {
        return this.jQueryElement.find(':selected').text(); // TODO Change to jQueryElement.select2('data')
    }

    getValue() {
        return this.getSelectedYear();
    }

}

const magicFunction = (data) => {
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
    return groupedData;
};

// Load tendencies per year
document.addEventListener('DOMContentLoaded', async () => {

    const initialYearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    initialYearSelect.setPlaceholder('Año Inicial');
    await initialYearSelect.bind($(`article.tendencies select[name="tendencias-initialYear"]`));

    const finalYearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    finalYearSelect.setPlaceholder('Año Final');
    await finalYearSelect.bind($(`article.tendencies select[name="tendencias-finalYear"]`));

    const tendenciesChart_v2 = new TendencyChart('tendencia', {cumulative: false, total: true});
    tendenciesChart_v2.setTitleText(TENDENCIES_TITLE);
    tendenciesChart_v2.setSubtitleText(`por semana epidemiológica de notificación, por año`);
    tendenciesChart_v2.setXAxisText(`Semanas Epidemiológicas`);
    tendenciesChart_v2.setYAxisText(`N&deg; de Casos`);
    tendenciesChart_v2.setCreditsText(`Programa Nacional de Enfermedades Vectoriales - PNVEV/DIVET - DGVS. Actualizado a la fecha: ${currentDate}`);
    tendenciesChart_v2.bindExportingButton(document.querySelector('article.tendencies button[name="export-pdf"]'), 'application/pdf');
    tendenciesChart_v2.bindExportingButton(document.querySelector('article.tendencies button[name="export-svg"]'), 'image/svg+xml');
    tendenciesChart_v2.bindExportingButton(document.querySelector('article.tendencies button[name="export-xls"]'), 'application/vnd.ms-excel');
    tendenciesChart_v2.bindExportingButton(document.querySelector('article.tendencies button[name="export-csv"]'), 'text/csv');
    tendenciesChart_v2.draw();
    const tendenciesChart = tendenciesChart_v2.getChartObject();

    $('article.tendencies button[name="tendencias-submit"]').on('click', () => {

        const initialYear = initialYearSelect.getValue();
        if(initialYear === '') console.log('Debe seleccionar un año inicial');
        
        const finalYear = finalYearSelect.getValue();
        if(finalYear === '') console.log('Debe seleccionar un año final');

        if(initialYear === '' || finalYear === '') return;
        
        let GETParams = new URLSearchParams({
            InitialYear: initialYear,
            FinalYear: finalYear,
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });
        GETParams.append('groupBy[]', 'Year');
        GETParams.append('groupBy[]', 'SemanaEpidemiologica');

        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?` + GETParams)
            .then(res => res.json())
            .then(data => {
                const groupedData = magicFunction(data);
                tendenciesChart_v2.removeAllSeries();
                tendenciesChart_v2.removeCurrentWeek();

                if(EPIWEEK >= 1 && (new Date()).getFullYear() <= finalYear){
                    tendenciesChart_v2.addCurrentWeek(EPIWEEK);
                }
    
                _(groupedData).mapValues((yearData, year) => {
                    const yearDataCasted = yearData.map(({x, y}) => ({x: parseInt(x), y: parseInt(y)}));
                    tendenciesChart_v2.addSeries(yearDataCasted, parseInt(year))
                }).value();

                // Add grand total (on top of plot)
                const calculateTotal = (groupedData) => {
                    let grandTotal = 0;
                    for(const [year, yearData] of Object.entries(groupedData)) {
                        const total = yearData.reduce((acc, {y}) => acc + parseInt(y), 0);
                        grandTotal += total;
                    }
                    return grandTotal;
                };

                // document.getElementById('total-begining').innerHTML = initialYear;
                // document.getElementById('total-ending').innerHTML = finalYear;
                document.getElementById('total-disease').innerHTML = DISEASETITLE;
                document.getElementById('total-total').innerHTML = calculateTotal(groupedData);;
                document.getElementsByClassName('totals')[0].classList.add('visible');
            });
    });

});

// Load tendencies of children
document.addEventListener('DOMContentLoaded', async () => {

    if(DISEASE_CHILDREN.length === 0) return;

    const yearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    yearSelect.setPlaceholder('Año');
    await yearSelect.bind($(`article.tendencies-children select[name="tendencias-2-year"]`));

    const childrenChart_v2 = new TendencyChart('tendencia-hijos', {displayTotal: true, cumulative: false});
    childrenChart_v2.setTitleText(CHILDREN_TENDENCIES_TITLE);
    childrenChart_v2.setSubtitleText(`por semana epidemiológica de notificación por enfermedades`);
    childrenChart_v2.setXAxisText(`Semanas Epidemiológicas`);
    childrenChart_v2.setYAxisText(`N&deg; de Casos`);
    childrenChart_v2.setCreditsText(`Programa Nacional de Enfermedades Vectoriales - PNVEV/DIVET - DGVS. Actualizado a la fecha: ${currentDate}`);
    childrenChart_v2.bindExportingButton(document.querySelector('article.tendencies-children button[name="export-pdf"]'), 'application/pdf');
    childrenChart_v2.bindExportingButton(document.querySelector('article.tendencies-children button[name="export-svg"]'), 'image/svg+xml');
    childrenChart_v2.bindExportingButton(document.querySelector('article.tendencies-children button[name="export-xls"]'), 'application/vnd.ms-excel');
    childrenChart_v2.draw();
    const childrenChart = childrenChart_v2.getChartObject();

    $('article.tendencies-children button[name="tendencias-submit"]').on('click', async () => {

        const year = yearSelect.getValue();
        if(year === '') console.log('Debe seleccionar un año inicial');

        if(year === '') return;
        
        let GETParams = new URLSearchParams({
            InitialYear: year,
            FinalYear: year, 
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });
        GETParams.append('groupBy[]', 'Year');
        GETParams.append('groupBy[]', 'SemanaEpidemiologica');

        childrenChart_v2.removeAllSeries();
        childrenChart_v2.removeCurrentWeek();

        if(EPIWEEK >= 1 && (new Date()).getFullYear() <= year){
            childrenChart_v2.addCurrentWeek(EPIWEEK);
        }

        for(const disease_child of DISEASE_CHILDREN){
            const data = await fetch(`${ROOT_URL}/api/v1/diseases/${disease_child.id}/tendencies?` + GETParams).then(res => res.json());
            const groupedData = magicFunction(data);
            _(groupedData).mapValues((yearData, year) => {
                const yearDataCasted = yearData.map(({x, y}) => ({x: parseInt(x), y: parseInt(y)}));
                childrenChart_v2.addSeries(yearDataCasted, disease_child.name)
            }).value();
        }
    });

});

// Load horizontal
document.addEventListener('DOMContentLoaded', async () => {

    const yearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    yearSelect.setPlaceholder('Año');
    await yearSelect.bind($(`select[name="horizontalBar-year"]`));

    const horizontalChart_v2 = new HorizontalBarsChart('barHorizontal');
    horizontalChart_v2.setTitleText(DISTRIBUTION_TITLE);
    horizontalChart_v2.setSubtitleText(`por rango de edad y sexo`);
    horizontalChart_v2.setYAxisText(`Cantidad de Casos`);
    horizontalChart_v2.setCreditsText(`Programa Nacional de Enfermedades Vectoriales - PNVEV/DIVET - DGVS. Actualizado a la fecha: ${currentDate}`);
    horizontalChart_v2.bindExportingButton(document.querySelector('article.horizontalBar button[name="export-pdf"]'), 'application/pdf');
    horizontalChart_v2.bindExportingButton(document.querySelector('article.horizontalBar button[name="export-svg"]'), 'image/svg+xml');
    horizontalChart_v2.bindExportingButton(document.querySelector('article.horizontalBar button[name="export-xls"]'), 'application/vnd.ms-excel');
    horizontalChart_v2.draw();
    const horizontalChart = horizontalChart_v2.getChartObject();

    $('button[name="horizontalBar-submit"]').on('click', (e) => {
        const year = yearSelect.getValue();

        if(year === '') console.log('Debe seleccionar un año');

        if(year === '') return;

        let GETParams = new URLSearchParams({
            InitialYear: year,
            FinalYear: year,
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });
        GETParams.append('groupBy[]', 'Sexo');
        GETParams.append('groupBy[]', 'GrupoEtareo');

        const categoriesPriorities = {
            "SD": 0,
            "< 2": 5,
            "2 a 4": 10,
            "5 a 19": 20,
            "20 a 39": 30,
            "40 a 49": 35,
            "40 a 59": 40,
            "60 y mas": 50
        };

        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/tendencies?` + GETParams)
            .then(res => res.json())
            .then(data => {

                const categories = _(data).map('GrupoEtareo').uniq().value();
                categories.sort((a, b) => categoriesPriorities[a] < categoriesPriorities[b]);
                console.log(categories);

                console.log(data);
                const x = _(data)
                    .groupBy('Year')
                    .mapValues((yearData, year) => _(yearData).groupBy('Sexo').mapValues(v => v.map(o => [o.GrupoEtareo, o.Total])).value())
                    .value();
                console.log(x);

                horizontalChart_v2.removeAllSeries();

                _(x[$('select[name="horizontalBar-year"]').find(':selected').text()]).mapValues((genderData, gender) => {
                    console.log(genderData);
                    const genderDataCasted = genderData.map(([x, y]) => [x, parseInt(y)]);
                    // Add dummy values to sort categories
                    for(let i = 0; i < categories.length; i++)
                        if(!genderDataCasted.map(p => p[0]).find(o => o === categories[i]))
                            genderDataCasted.push([categories[i], 0]);
                    
                    genderDataCasted.sort((a, b) => {
                        const x = categories.indexOf(a[0]);
                        const y = categories.indexOf(b[0]);
                        // console.log(x, a, 'v.', y, b, ' = ', x < y);
                        return x < y; 
                    });
                    console.log(genderDataCasted);
                    
                    horizontalChart_v2.addSeries(genderDataCasted, gender);
                }).value();

            });
    });
});

// Load regions map
document.addEventListener('DOMContentLoaded', async () => {
    const topo_data = await fetch(`${ROOT_URL}/api/v1/regionMap`).then(res => res.json());
    console.log(topo_data);

    const yearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    yearSelect.setPlaceholder('Año');
    await yearSelect.bind($(`select[name="regions-heatmap-year"]`));

    const map = new Choropleth('map-regions');
    map.setTitleText(REGIONS_HEATMAP_TITLE);
    map.setSubtitleText(`por departamentos`);
    map.setCreditsText(`Fuente: PNVEV - DGVS | Según los datos de la fecha: ${currentDate}`);
    map.bindExportingButton(document.querySelector('article.region-heatmap button[name="export-pdf"]'), 'application/pdf');
    map.bindExportingButton(document.querySelector('article.region-heatmap button[name="export-svg"]'), 'image/svg+xml');
    map.bindExportingButton(document.querySelector('article.region-heatmap button[name="export-xls"]'), 'application/vnd.ms-excel');
    map.draw();

    $('button[name="regions-heatmap-submit"]').on('click', (e) => {
        const year = yearSelect.getValue();

        if(year === '') console.log('Debe seleccionar un año');

        if(year === '') return;

        let GETParams = new URLSearchParams({
            InitialYear: year,
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });

        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/map?` + GETParams)
            .then(res => res.json())
            .then(points_data => {
                points_data = _(points_data).map((o) => [o.Longitud, o.Latitud]).value();
                console.log(points_data);

                const regionNameExtractor = (feature) => feature.properties.ADM1_ES;
                const regionPolygonExtractor = (feature) => feature.geometry.coordinates[0][0];

                const data = [];
                for(const feature of topo_data.features){
                    const regionName = regionNameExtractor(feature);
                    const regionPolygon = regionPolygonExtractor(feature);
                    
                    var numberOfPoints = 0;
                    for(const point of points_data){
                        const isInside = geometric.pointInPolygon(point, regionPolygon);
                        if(isInside){
                            numberOfPoints++;
                        }
                    }

                    const regionData = {
                        name: regionName,
                        value: numberOfPoints,
                        // value: Math.random() * 100,
                    };
                    data.push(regionData);
                }

                map.setData(data);
                map.setMapData(topo_data);
                map.setJoinBy(['ADM1_ES', 'name']);
                map.draw();
            });
    });
});

// Load districts map
document.addEventListener('DOMContentLoaded', async () => {
    const topo_data = await fetch(`${ROOT_URL}/api/v1/districtMap`).then(res => res.json());
    // const points_pr = fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/map`).then(res => res.json());

    const yearSelect = new YearSelect(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/years`);
    yearSelect.setPlaceholder('Año');
    await yearSelect.bind($(`select[name="districts-heatmap-year"]`));

    const map = new Choropleth('map-districts');
    map.setTitleText(DISTRICTS_HEATMAP_TITLE);
    map.setSubtitleText(`por distritos`);
    map.setCreditsText(`Fuente: PNVEV - DGVS | Según los datos de la fecha: ${currentDate}`);
    map.bindExportingButton(document.querySelector('article.district-heatmap button[name="export-pdf"]'), 'application/pdf');
    map.bindExportingButton(document.querySelector('article.district-heatmap button[name="export-svg"]'), 'image/svg+xml');
    map.bindExportingButton(document.querySelector('article.district-heatmap button[name="export-xls"]'), 'application/vnd.ms-excel');
    map.draw();

    $('button[name="districts-heatmap-submit"]').on('click', (e) => {
        const year = yearSelect.getValue();

        if(year === '') console.log('Debe seleccionar un año');

        if(year === '') return;

        let GETParams = new URLSearchParams({
            InitialYear: year,
            InitialEpiweek: 1,
            FinalEpiweek: 53,
        });

        fetch(`${ROOT_URL}/api/v1/diseases/${DISEASE_ID}/map?` + GETParams)
            .then(res => res.json())
            .then(points_data => {
                points_data = _(points_data).map((o) => [o.Longitud, o.Latitud]).value();
                console.log('>>', points_data);

                const regionNameExtractor = (feature) => feature.properties.ADM2_ES;
                const regionPolygonExtractor = (feature) => feature.geometry.coordinates[0][0];

                const data = [];
                for(const feature of topo_data.features){
                    const regionName = regionNameExtractor(feature);
                    const regionPolygon = regionPolygonExtractor(feature);
                    
                    var numberOfPoints = 0;
                    for(const point of points_data){
                        const isInside = geometric.pointInPolygon(point, regionPolygon);
                        if(isInside){
                            numberOfPoints++;
                        }
                    }

                    const regionData = {
                        name: regionName,
                        value: numberOfPoints,
                        // value: Math.random() * 100,
                    };
                    data.push(regionData);
                }

                map.setData(data);
                map.setMapData(topo_data);
                map.setJoinBy(['ADM2_ES', 'name']);
                map.draw();
            });
    });
});

import { epiweeks, chartTitleStyle, chartCaptionStyle, chartYTitleStyle, chartXLabelStyle } from '../utils.js';

const chartGenerator = (chartContainerId, diseaseTitle) => {
    return Highcharts.chart(chartContainerId, {
        chart: {
            type: 'bar'
        },
        title: {
            text: `Barras Horizontales de ${diseaseTitle} (Columna 4 de la tabla de requerimientos)`,
            style: chartTitleStyle,
        },
        xAxis: {
            categories: [ "20 a 39", "40 a 59", "5 a 19", "60 y mas", "SD" ],
            labels: {
                style: chartXLabelStyle,
            }
        },
        yAxis: {
            title: {
                text: 'Cantidad de Casos',
                style: chartYTitleStyle,
            }
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        caption: {
            text: '<strong>Lorem.</strong><br><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em>',
            style: chartCaptionStyle,
        }
    })
}

export { chartGenerator };
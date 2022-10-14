import { epiweeks, chartTitleStyle, chartCaptionStyle, chartYTitleStyle, chartXTitleStyle, chartXLabelStyle } from '../utils.js';

const chartGenerator = (chartContainerId, diseaseTitle) => {
    return Highcharts.chart(chartContainerId, {
        chart: {
            type: 'line'
        },
        title: {
            text: `Tendencia de Casos Confirmados de ${diseaseTitle}, por Semana Epidemiológica`,
            style: chartTitleStyle,
        },
        xAxis: {
            title: {
                text: 'Semanas Epidemiológicas',
                style: chartXTitleStyle,
            },
            categories: epiweeks,
            labels: {
                style: chartXLabelStyle,
            }
        },
        yAxis: {
            title: {
                text: 'N&deg; de Casos',
                style: chartYTitleStyle,
            }
        },
        // caption: {
        //     text: '<strong>Lorem.</strong><br><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em>',
        //     style: chartCaptionStyle,
        // },
        credits: {
            text: `Fuente: PNVEV - DGVS | Según los datos de la fecha: dd/mm/yyyy`,
            position: {
                align: 'right',
            },
            style: {
                fontSize: '11px',
            },
        },
        plotOptions: {
            line: {
                marker: {
                    enabled: false
                }
            },
            series: {
                lineWidth: 1,
                states: {
                    hover: {
                        enabled: true,
                        lineWidth: 4
                    }
                }
            },
        }
    })
};

export { chartGenerator };
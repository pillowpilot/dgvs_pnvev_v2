import { epiweeks, chartTitleStyle, chartCaptionStyle, chartYTitleStyle, chartXLabelStyle } from '../utils.js';

class HorizontalBarsChart {
    constructor(containerId) {
        this.containerId = containerId;
    }

    // https://highcharts.com/docs/chart-concepts/title-and-subtitle
    setTitleText(titleText) {
        this.titleText = titleText;
    }

    setSubtitleText(subtitleText) {
        this.subtitleText = subtitleText;
    }

    setXAxisText(xAxisText) {
        this.xAxisText = xAxisText;
    }

    setYAxisText(yAxisText) {
        this.yAxisText = yAxisText;
    }

    setCreditsText(creditsText) {
        this.creditsText = creditsText;
    }

    // https://highcharts.com/docs/chart-concepts/series
    addSeries(series, name) {
        if(!name) name = 'Unnamed Series';

        this.chart.addSeries({
            name: name,
            data: series,
        });
    }

    removeAllSeries() {
        while (this.chart.series.length) {
            this.chart.series[0].remove(false); // false = do not redraw
        }
        this.chart.redraw();
    }

    getChartObject() {
        return this.chart;
    }

    bindExportingButton(btnElement, exportFormat) {
        btnElement.addEventListener('click', () => {
            this.chart.exportChart({
                type: exportFormat,
                filename: `chart`,
            });
        });
    }

    generateChartOptions() {
        return {
            chart: {
                type: 'bar'
            },
            title: {
                text: this.titleText,
                style: chartTitleStyle,
            },
            subtitle: {
                text: this.subtitleText,
            },
            xAxis: {
                type: 'category',
                labels: {
                    style: chartXLabelStyle,
                }
            },
            yAxis: {
                title: {
                    text: this.yAxisText,
                    style: chartYTitleStyle,
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            colors: ['#6d9eeb', '#46bdc6'],
            // caption: {
            //     text: '<strong>Lorem.</strong><br><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em>',
            //     style: chartCaptionStyle,
            // },
            credits: {
                text: this.creditsText,
                position: {
                    align: 'right',
                },
                style: {
                    fontSize: '11px',
                },
            },
        };
    }

    draw() {
        const chartOptions = this.generateChartOptions();
        this.chart = Highcharts.chart(this.containerId, chartOptions);
    }
}

export { HorizontalBarsChart };
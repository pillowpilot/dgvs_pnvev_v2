import { epiweeks, chartTitleStyle, chartCaptionStyle, chartYTitleStyle, chartXTitleStyle, chartXLabelStyle } from '../utils.js';

class TendencyChart {
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
                type: 'line'
            },
            title: {
                text: this.titleText,
                style: chartTitleStyle,
            },
            subtitle: {
                text: this.subtitleText,
            },
            xAxis: {
                title: {
                    text: this.xAxisText,
                    style: chartXTitleStyle,
                },
                categories: epiweeks,
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
        };
    }

    draw() {
        const chartOptions = this.generateChartOptions();
        this.chart = Highcharts.chart(this.containerId, chartOptions);
    }
}

export { TendencyChart };
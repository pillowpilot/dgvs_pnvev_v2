import { epiweeks, chartTitleStyle, chartCaptionStyle, chartYTitleStyle, chartXTitleStyle, chartXLabelStyle } from '../utils.js';

class SeriesUtilFunctions {
    static sortSeries(series) {
        return series.sort((a, b) => a.x > b.x);
    }

    static buildAccumulateSeries(series) {
        const seriesSorted = this.sortSeries(series);

        let accumulated = [];
        let acc = 0;
        for(const point of series) {
            accumulated.push({x: point.x, y: point.y + acc});
            acc += point.y;
        }
        return accumulated;
    }

    static buildHashmapFromSeries(series) {
        let hashmap = new Map();
        for(const point of series)
            hashmap.set(point.x, point.y);
        return hashmap;
    }
    
    static buildSeriesFromHashmap(hashmap) {
        let series = [];
        for(const key of hashmap.keys())
            series.push({x: key, y: hashmap.get(key)});
        return series;
    }

    static aggregatePairOfSeries(seriesA, seriesB) {
        const mapA = this.buildHashmapFromSeries(seriesA);
        const mapB = this.buildHashmapFromSeries(seriesB);

        const mapResult = new Map();
        for(const key of mapA.keys())
            if(!mapResult.has(key))
                mapResult.set(key, mapA.get(key));

        for(const key of mapB.keys())
            if(!mapResult.has(key))
                mapResult.set(key, mapB.get(key));
            else
                mapResult.set(key, mapResult.get(key) + mapB.get(key));

        const seriesResult = this.sortSeries(this.buildSeriesFromHashmap(mapResult));
        return seriesResult;
    }
}

class TendencyChart {
    constructor(containerId, options = {displayTotal: false, cumulative: false}) {
        this.containerId = containerId;

        this.displayAggregatedSeries = options.displayTotal?true:false;

        this.aggregatedSeries = [];
        this.aggregatedSeriesName = 'Total';
        this.aggregatedSeriesId = this.aggregatedSeriesName;

        this.transformIntoCummulative = options.cumulative?true:false;
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

    addCurrentWeek(currentWeek) {
        const xAxis = this.chart.xAxis[0];
        xAxis.addPlotLine({
            value: currentWeek,
            color: 'red',
            width: 2,
            dashStyle: 'ShortDash',
            id: 'current-week',
            label: {
                text: 'SE Actual',
            }
        });
    }

    removeCurrentWeek() {
        const xAxis = this.chart.xAxis[0];
        xAxis.removePlotLine('current-week');
    }

    // https://highcharts.com/docs/chart-concepts/series
    /*
        Expected format array of objects with properties x and y, 
        [{x: ..., y: ...}, {x: ..., y: ...}, {x: ..., y: ...}].
    */
    addSeries(series, name) {
        if(!name) name = 'Unnamed Series';

        if(this.transformIntoCummulative) {
            series = SeriesUtilFunctions.buildAccumulateSeries(series);
        }

        this.aggregatedSeries = SeriesUtilFunctions.aggregatePairOfSeries(this.aggregatedSeries, series);

        this.chart.addSeries({
            id: name,
            name: name,
            data: series,
        });

        if(this.chart.get(this.aggregatedSeriesId))
            this.chart.get(this.aggregatedSeriesId).remove(false); // false = do not redraw

        if(this.displayAggregatedSeries)
            this.chart.addSeries({
                id: this.aggregatedSeriesId,
                name: this.aggregatedSeriesName, 
                data: this.aggregatedSeries,
            }); // .add redraws the chart
    }

    removeAllSeries() {
        this.aggregatedSeries = [];

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
            if(exportFormat === 'application/vnd.ms-excel') {
                this.chart.downloadXLS();
            }else if(exportFormat === 'text/csv') {
                this.chart.downloadCSV();
            }else{
                this.chart.exportChart({
                    type: exportFormat,
                    filename: `chart`,
                });
            }
        });
    }

    generateChartOptions() {
        let options = {
            chart: {
                type: 'column'
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
                min: 1,  // Min value
                max: 53, // Max value 
                tickInterval: 1, // Show all ticks
                labels: {
                    style: chartXLabelStyle,
                },
            },
            yAxis: {
                title: {
                    text: this.yAxisText,
                    style: chartYTitleStyle,
                }
            },
            tooltip: {
                useHTML: true,
                headerFormat: '<span style="font-size:1.2rem">Semana Epidemiológica: {point.key}</span><table>',
                pointFormat: '<tr><td style="font-size:1rem;/*color:{series.color}*/;padding:0">{series.name}: </td>' + 
                    '<td style="font-size:1rem;padding:0 0 0 0.5rem"><b>{point.y:.0f} caso(s)</b></td></tr>',
                footerFormat: '</table>',  
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
                column: {
                    // pointPadding: 0, // Distance between columns in the same group
                    // groupPadding: 0, // Distance between groups of columns
                    // borderWidth: 0,
                    pointRange: 1, // The X axis range that each point is valid for (https://api.highcharts.com/highcharts/plotOptions.column.pointRange).
                },
                line: {
                    marker: {
                        enabled: true
                    }
                },
                series: {
                    // lineWidth: 1,
                    states: {
                        hover: {
                            enabled: true,
                            lineWidth: 4
                        }
                    }
                },
            }
        };

        return options;
    }

    draw() {
        const chartOptions = this.generateChartOptions();
        this.chart = Highcharts.chart(this.containerId, chartOptions);
    }
}

export { TendencyChart };
class Choropleth {
    constructor(containerId) {
        this.containerId = containerId;
    }

    setTitleText(titleText) {
        this.titleText = titleText;
    }

    setSubtitleText(subtitleText) {
        this.subtitleText = subtitleText;
    }

    setCreditsText(creditsText) {
        this.creditsText = creditsText;
    }

    setData(data) {
        this.data = data;
    }

    setMapData(mapData) {
        this.mapData = mapData;
    }

    setJoinBy(joinBy) {
        this.joinBy = joinBy;
    }

    generateChartOptions() {
        let options = {
            chart: {
                map: this.mapData,
            },

            title: {
                text: this.titleText,
            },

            subtitle: {
                text: this.subtitleText,
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
                text: this.creditsText,
                position: {
                    align: 'right',
                },
                style: {
                    fontSize: '11px',
                },
            },

            tooltip: {
                formatter: function(tooltip) {
                    return `<strong>${this.point.options.name}</strong><br/>Casos: ${this.point.value}`;
                },
            },

            series: [{
                data: this.data,
                joinBy: this.joinBy,
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
        };

        return options;
    }

    draw() {
        const chartOptions = this.generateChartOptions();
        this.chart = Highcharts.mapChart(this.containerId, chartOptions);
    }
}

export { Choropleth };
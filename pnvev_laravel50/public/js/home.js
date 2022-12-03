document.addEventListener('DOMContentLoaded', () => {
    const data = 
    [
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Fiebre Amarilla", name_lvl_3:"", year: 2020, count: 0},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Fiebre Amarilla", name_lvl_3:"", year: 2021, count: 0},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Fiebre Amarilla", name_lvl_3:"", year: 2022, count: 0},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Visceral", year: 2020, count: 12},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Visceral", year: 2021, count: 52},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Visceral", year: 2022, count: 51},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Tegumentaria", year: 2020, count: 32},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Tegumentaria", year: 2021, count: 31},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leishmaniasis", name_lvl_3: "Tegumentaria", year: 2022, count: 41},
        
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Agudo", year: 2020, count: 4},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Agudo", year: 2021, count: 2},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Agudo", year: 2022, count: 1},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Cronico", year: 2020, count: 159},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Cronico", year: 2021, count: 113},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Chagas", name_lvl_3: "Cronico", year: 2022, count: 209},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Autoctono", year: 2020, count: 0},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Autoctono", year: 2021, count: 0},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Autoctono", year: 2022, count: 0},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Importado", year: 2020, count: 0},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Importado", year: 2021, count: 3},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Paludismo", name_lvl_3: "Importado", year: 2022, count: 2},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Hantavirus", name_lvl_3:"", year: 2020, count: 4},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Hantavirus", name_lvl_3:"", year: 2021, count: 7},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Hantavirus", name_lvl_3:"", year: 2022, count: 10},

        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leptopirosis", name_lvl_3:"", year: 2020, count: 1},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leptopirosis", name_lvl_3:"", year: 2021, count: 1},
        {name_lvl_1: "Vectoriales y Zoonoticas", name_lvl_2: "Leptopirosis", name_lvl_3:"", year: 2022, count: 0},

    ];
    const aggregator = function(data, rowKey, colKey) {
        return {
            numberOfCases: 0,
            push: function(record) {
                this.numberOfCases = record['count'];
            },
            value: function() {
                return this.numberOfCases; 
            },
            format: function(x) { return x; },
        };
    };
    const rendererOptions = {
        table: {
            rowTotals: false,
            colTotals: false,
        },
    };
    const options = {
        rows: ["name_lvl_1", "name_lvl_2", "name_lvl_3"],
        cols: ["year"],
        aggregator: aggregator,
        rendererOptions: rendererOptions,
    };
    const locale = 'es'; // Needs pivot.es.js
    // $('.table-container').pivot(data, options, locale);
});
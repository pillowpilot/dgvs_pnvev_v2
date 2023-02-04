import {TabulatorFull as Tabulator} from 'tabulator-tables';

document.addEventListener("DOMContentLoaded", () => {
  
});

document.addEventListener("DOMContentLoaded", () => {
  const elementId = "#table-container";
  const table = new Tabulator(elementId, {
    data: data, //load row data from array
    layout: "fitColumns", //fit columns to width of table
    responsiveLayout: "hide", //hide columns that dont fit on the table
    addRowPos: "top", //when adding a new row, add it to the top of the table
    history: true, //allow undo and redo actions on the table
    pagination: "local", //paginate the data
    paginationSize: 30, //allow 7 rows per page of data
    paginationCounter: "rows", //display count of paginated rows in footer
    columns: columnsDefinitions,
    locale: "es-es",
    langs: {
      "es-es": {
        pagination: {
          page_size: "Tamaño de Página", //label for the page size select element
          page_title: "Mostrar Página", //tooltip text for the numeric page button
          first: "Primero", //text for the first page button
          first_title: "Primera página", //tooltip text for the first page button
          last: "Último",
          last_title: "Última página",
          prev: "Anterior",
          prev_title: "Página anterior",
          next: "Siguiente",
          next_title: "Página siguiente",
          all: "Todos",
          counter: {
            showing: "Mostrando",
            of: "de",
            rows: "filas",
            pages: "páginas",
          },
        },
      },
    },
  });
  setTimeout(() => {
    table.redraw(true);
    console.log('REDRAW');
  }, 1000);
  document.getElementById("add-row").addEventListener("click", () => {
    table.addRow({}, false); // false => add row to the bottom
  });
  document.getElementById("clear-table").addEventListener("click", () => {
    table.clearData();
  });
  document.getElementById("reset-table").addEventListener("click", () => {
    table.clearData();
    table.setData(data);
  });
  document
    .getElementById("file-selector")
    .addEventListener("change", (event) => {
      const file = event.target.files[0];
      Papa.parse(file, {
        header: true, // First line contains column names
        complete: function (results) {
          table.setData(results.data);
        },
      });
    });
  document.getElementById("table-data-form").addEventListener("submit", () => {
    const data = table.getData();
    console.log("submitting", data);
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = "data";
    input.value = JSON.stringify(data);
    document.getElementById("table-data-form").appendChild(input);
  });
});

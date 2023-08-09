$(document).ready(function () {
  $("#tableListSer").DataTable({
    ajax: {
      url: "../cobranza/back/listSerPorCobrar.php",
    },
    deferRender: true,
    scrollY: 340,
    scrollX: true,
    stateSave: true,
    paging: true,
    /* select: true, */
    orderCellsTop: true,
    fixedHeader: true,
    lengthMenu: [
      [10, 20, 1000, -1],
      [10, 20, 1000, "Todos"],
    ],
    dom:
      "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    },
    order: [[0, "asc"]],
    columns: [
      {
        data: "num_ser",
      },
      {
        data: "tip_ser",
      },
      {
        data: "cliente",
      },
      {
        data: "cost_ser",
      },
      {
        data: "tip_pag",
      },
      {
        data: "dia_pag",
      },
      {
        data: "estatusPago",
        mRender: function (data, type, row) {
            return `<p style = "margin: 0px; padding: 1px; border-radius: 5px; background-color: ${row.colorEstPag}; text-align: center;">${data}</p>`;
          },
      },
      {
        data: "conct_pag",
      },
      {
        data: "tel_conpag",
      },
      {
        data: "cor_conpag",
      },
      {
        data: "estatus_serv",
      },
      {
        data: "id_ser",
        bSortable: false,
        mRender: function (data, type, row) {
          return ``
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de Servicios",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de Servicios",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de Servicios",
        text: '<i class="fas fa-file-pdf"></i>',
        className: "btn-sm",
        orientation: "landscape",
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        title: "Lista de Servicios",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de Servicios",
        className: "btn-sm",
        text: '<i class="fas fa-copy"></i>',
      },
      {
        extend: "colvis",
        className: "btn-sm",
        text: '<i class="fas fa-eye"></i>',
      },
      {
        extend: "print",
        text: '<i class="fas fa-print"></i>',
        className: "btn-sm",
        exportOptions: {
          modifier: {
            selected: null,
          },
        },
      },
    ],
  });
});
var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");
toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

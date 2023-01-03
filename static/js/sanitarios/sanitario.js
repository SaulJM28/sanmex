$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#tableSanitarios").DataTable({
    ajax: {
      url: "./back/get_listSanitarios.php",
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
        data: "num_san",
      },
      {
        data: "tip_san",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_san",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate"><i class="fas fa-edit" ></i></button>
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete"><i class="fas fa-trash" ></i></button>
           </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de sanitarios",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de sanitarios",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de sanitarios",
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
        title: "Lista de sanitarios",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de sanitarios",
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

function cargar_tabla() {
  $("#tableSanitarios").DataTable().clear().destroy();
  $("#tableSanitarios").DataTable({
    ajax: {
      url: "./back/get_listSanitarios.php",
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
        data: "num_san",
      },
      {
        data: "tip_san",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_san",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate"><i class="fas fa-edit" ></i></button>
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete"><i class="fas fa-trash" ></i></button>
           </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de sanitarios",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de sanitarios",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de sanitarios",
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
        title: "Lista de sanitarios",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de sanitarios",
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
}

formularioADDSanitario.addEventListener("submit", (e) => {
  e.preventDefault();
  let num_san_add = document.getElementById("num_san_add").value;
  let tip_san_add = document.getElementById("tip_san_add").value;
  $.ajax({
    type: "POST",
    url: "./back/insert_sanitario.php",
    data: {
      num_san_add: num_san_add,
      tip_san_add: tip_san_add,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Mensaje(response.mensaje, "success", "ADD");
        cargar_tabla();
        document.getElementById("num_san_add").value  = '';
      } else {
        Mensaje(response.mensaje, "danger", "ADD");
        cargar_tabla();
        document.getElementById("num_san_add").value  = '';
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

function Mensaje(mensaje, color, tipo) {
  switch (tipo) {
    case "ADD":
      document.getElementById(
        "mensajeADD"
      ).innerHTML = `<div class="alert alert-${color} alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Aviso! </strong> ${mensaje}
      </div>`;
    case "UPDATE":
      document.getElementById(
        "mensajeUP"
      ).innerHTML = `<div class="alert alert-${color} alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Aviso! </strong> ${mensaje}
      </div>`;
      break;
    case "DELETE":
      document.getElementById(
        "mensajeDE"
      ).innerHTML = `<div class="alert alert-${color} alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Aviso! </strong> ${mensaje}
      </div>`;
      break;
  }
}

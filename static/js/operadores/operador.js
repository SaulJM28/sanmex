$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#tablaOperadores").DataTable({
    ajax: {
      url: "./back/get_listOperadores.php",
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
        data: "nom",
      },
      {
        data: "ap1",
      },
      {
        data: "ap2",
      },
      {
        data: "tel",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_ope",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" onclick="get_info(${data}, 'delete'
               )"><i class="fas fa-trash" ></i></button>
             </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de operadore",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de operadores",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de operadores",
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
        title: "Lista de operadores",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de operadores",
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
  $("#tablaOperadores").DataTable().clear().destroy();
  $("#tablaOperadores").DataTable({
    ajax: {
      url: "./back/get_listOperadores.php",
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
        data: "nom",
      },
      {
        data: "ap1",
      },
      {
        data: "ap2",
      },
      {
        data: "tel",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_ope",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" onclick="get_info(${data}, 'delete'
               )"><i class="fas fa-trash" ></i></button>
             </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de operadore",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de operadores",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de operadores",
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
        title: "Lista de operadores",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de operadores",
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

formularioADDOperador.addEventListener("submit", (e) => {
  e.preventDefault();
  let nom_ope_add = document.getElementById("nom_ope_add").value;
  let ap1_ope_add = document.getElementById("ap1_ope_add").value;
  let ap2_ope_add = document.getElementById("ap2_ope_add").value;
  let tel_ope_add = document.getElementById("tel_ope_add").value;

  tel_ope_add ? "" : (tel_ope_add = "N/A");

  //poner validaciones de campos
  $.ajax({
    type: "POST",
    url: "./back/insert_operador.php",
    data: {
      nom_ope_add: nom_ope_add,
      ap1_ope_add: ap1_ope_add,
      ap2_ope_add: ap2_ope_add,
      tel_ope_add: tel_ope_add,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Mensaje(response.mensaje, "success", "ADD");
        cargar_tabla();
        document.getElementById("nom_ope_add").value = "";
        document.getElementById("ap1_ope_add").value = "";
        document.getElementById("ap2_ope_add").value = "";
        document.getElementById("tel_ope_add").value = "";
      } else {
        Mensaje(response.mensaje, "danger", "ADD");
        cargar_tabla();
        document.getElementById("nom_ope_add").value = "";
        document.getElementById("ap1_ope_add").value = "";
        document.getElementById("ap2_ope_add").value = "";
        document.getElementById("tel_ope_add").value = "";
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

//funcion para obtener datos de la fila
const get_info = (id, tipo) => {
  if (tipo == "update") {
    $.ajax({
      type: "POST",
      url: "./back/get_opeById.php",
      data: {
        id_ope: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_ope_up").value = response.id_ope;
        document.getElementById("nombre_ope_up").value = response.nom;
        document.getElementById("ap1_ope_up").value = response.ap1;
        document.getElementById("ap2_ope_up").value = response.ap2;
        document.getElementById("tel_op_up").value = response.tel;
      },
      error: function (error) {
        console.log(error);
      },
    });
  } else if (tipo == "delete") {
    $.ajax({
      type: "POST",
      url: "./back/get_opeById.php",
      data: {
        id_ope: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_ope_de").value = response.id_ope;
        document.getElementById(
          "nom_ope_de"
        ).value = `${response.nom}  ${response.ap1}  ${response.ap2}`;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
};
/*  funcion para actualizar la informacion */
formularioUpdateoperador.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_ope_up = document.getElementById("id_ope_up").value;
  let nombre_ope_up = document.getElementById("nombre_ope_up").value;
  let ap1_ope_up = document.getElementById("ap1_ope_up").value;
  let ap2_ope_up = document.getElementById("ap2_ope_up").value;
  let tel_op_up = document.getElementById("tel_op_up").value;
  $.ajax({
    type: "POST",
    url: "./back/update_ope.php",
    data: {
      id_ope: id_ope_up,
      nombre_ope: nombre_ope_up,
      ap1_ope: ap1_ope_up,
      ap2_ope: ap2_ope_up,
      tel_op: tel_op_up,
      accion: "update",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Mensaje(response.mensaje, "success", "UPDATE");
        cargar_tabla();
        document.getElementById("nombre_ope_up").value = "";
        document.getElementById("ap1_ope_up").value = "";
        document.getElementById("ap2_ope_up").value = "";
        document.getElementById("tel_op_up").value = "";
      } else {
        Mensaje(response.mensaje, "danger", "UPDATE");
        cargar_tabla();
        document.getElementById("nombre_ope_up").value = "";
        document.getElementById("ap1_ope_up").value = "";
        document.getElementById("ap2_ope_up").value = "";
        document.getElementById("tel_op_up").value = "";
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteoperador.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_ope_de = document.getElementById("id_ope_de").value;
  $.ajax({
    type: "POST",
    url: "./back/update_ope.php",
    data: {
      id_ope: id_ope_de,
      nombre_ope: null,
      ap1_ope: null,
      ap2_ope: null,
      tel_op: null,
      accion: "delete",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Mensaje(response.mensaje, "success", "DELETE");
        cargar_tabla();
      } else {
        Mensaje(response.mensaje, "danger", "DELETE");
        cargar_tabla();
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

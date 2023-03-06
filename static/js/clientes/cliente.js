$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#datatableListClient ").DataTable({
    ajax: {
      url: "./back/get_listClie.php",
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
        data: "nom_clie",
      },
      {
        data: "tel_clie",
      },
      {
        data: "rfc",
      },
      {
        data: "razon_social",
      },
      {
        data: "nom_con",
      },
      {
        data: "num_con",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_clie",
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
        title: "Lista de clientes",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de clientess",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de clientess",
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
        title: "Lista de clientess",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de clientess",
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

formularioADDCliente.addEventListener("submit", (e) => {
  e.preventDefault();
  let nom_clie_add = document.getElementById("nom_clie_add").value;
  let tel_clie_add= document.getElementById("tel_clie_add").value;
  let rfc_clie_add = document.getElementById("rfc_clie_add").value;
  let razsoc_clie_add = document.getElementById("razsoc_clie_add").value;
  let nomcon_clie_add = document.getElementById("nomcon_clie_add").value;
  let numtel_clie_add = document.getElementById("numtel_clie_add").value;
  //poner validaciones de campos
  $.ajax({
    type: "POST",
    url: "./back/insert_cliente.php",
    data: {
      nom_clie_add: nom_clie_add,
      tel_clie_add: tel_clie_add,
      rfc_clie_add: rfc_clie_add,
      razsoc_clie_add: razsoc_clie_add,
      nomcon_clie_add: nomcon_clie_add,
      numtel_clie_add: numtel_clie_add,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'success'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("nom_clie_add").value = "";
        document.getElementById("tel_clie_add").value = "";
        document.getElementById("rfc_clie_add").value = "";
        document.getElementById("razsoc_clie_add").value = "";
        document.getElementById("nomcon_clie_add").value = "";
        document.getElementById("numtel_clie_add").value = "";
      } else {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'error'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("nom_clie_add").value = "";
        document.getElementById("tel_clie_add").value = "";
        document.getElementById("rfc_clie_add").value = "";
        document.getElementById("razsoc_clie_add").value = "";
        document.getElementById("nomcon_clie_add").value = "";
        document.getElementById("numtel_clie_add").value = "";
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
      url: "./back/get_listClieById.php",
      data: {
        id_clie: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_up").value = response.id_clie;
        document.getElementById("nom_clie_up").value = response.nom_clie;
        document.getElementById("tel_clie_up").value = response.tel_clie;
        document.getElementById("rfc_clie_up").value = response.rfc;
        document.getElementById("razsoc_clie_up").value = response.razon_social;
        document.getElementById("nomcon_clie_up").value = response.nom_con;
        document.getElementById("numtel_clie_up").value = response.num_con;
      },
      error: function (error) {
        console.log(error);
      },
    });
  } else if (tipo == "delete") {
    $.ajax({
      type: "POST",
      url: "./back/get_listClieById.php",
      data: {
        id_clie: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_de").value = response.id_clie;
        document.getElementById("nom_clie_de").value = response.nom_clie;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
};
/*  funcion para actualizar la informacion */
formularioUPDATECliente.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_up = document.getElementById("id_up").value;
  let nom_clie_up = document.getElementById("nom_clie_up").value;
  let tel_clie_up = document.getElementById("tel_clie_up").value;
  let rfc_clie_up = document.getElementById("rfc_clie_up").value;
  let razsoc_clie_up = document.getElementById("razsoc_clie_up").value;
  let nomcon_clie_up = document.getElementById("nomcon_clie_up").value;
  let numtel_clie_up = document.getElementById("numtel_clie_up").value;
  $.ajax({
    type: "POST",
    url: "./back/update_cliente.php",
    data: {
      id: id_up,
      nom_clie: nom_clie_up,
      tel_clie: tel_clie_up,
      rfc_clie: rfc_clie_up,
      razsoc_clie: razsoc_clie_up,
      nomcon_clie: nomcon_clie_up,
      numtel_clie: numtel_clie_up,
      accion: "update",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'success'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("id_up").value = "";
        document.getElementById("nom_clie_up").value = "";
        document.getElementById("tel_clie_up").value = "";
        document.getElementById("rfc_clie_up").value = "";
        document.getElementById("razsoc_clie_up").value = "";
        document.getElementById("nomcon_clie_up").value = "";
        document.getElementById("numtel_clie_up").value = "";
      } else {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'error'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("nom_clie_up").value = "";
        document.getElementById("tel_clie_up").value = "";
        document.getElementById("rfc_clie_up").value = "";
        document.getElementById("razsoc_clie_up").value = "";
        document.getElementById("nomcon_clie_up").value = "";
        document.getElementById("numtel_clie_up").value = "";
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteCliente.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_de = document.getElementById("id_de").value;
  $.ajax({
    type: "POST",
    url: "./back/update_cliente.php",
    data: {
      id: id_de,
      nom_clie: null,
      tel_clie: null,
      rfc_clie: null,
      razsoc_clie: null,
      nomcon_clie: null,
      numtel_clie: null,
      accion: "delete",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'success'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("id_de").value = "";
        document.getElementById("nom_clie_de").value = "";
      } else {
        Swal.fire(
          'Alerta',
          `${response.mensaje}`,
          'error'
        )
        $("#datatableListClient ").DataTable().ajax.reload();
        document.getElementById("id_de").value = "";
        document.getElementById("nom_clie_de").value = "";
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});



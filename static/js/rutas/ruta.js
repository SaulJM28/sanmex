$(document).ready(function () {
  $("#tableRutas").DataTable({
    ajax: {
      url: "./back/get_listRutas.php",
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
        data: "nom_rut",
      },
      {
        data: "operador",
      },
      {
        data: "estatus",
      },
      {
        data: "id_rut",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" title="Editar" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" title="Eliminar" onclick="get_info(${data}, 'delete')"><i class="fas fa-trash" ></i></button>
            </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de Rutas",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de Rutas",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de Rutas",
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
        title: "Lista de Rutas",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de Rutas",
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
const GetOperador = () =>{
  $.ajax({
    type: "GET",
    url: "../operadores/back/get_listOperadores.php",
    async: true,
    beforeSend: function () {},
    success: function (response) {
      let html = `<option value = "" selected >Seleccione un operador</option>`
      response.data.forEach(element => {
        html += `<option value = "${element.id_ope}">${element.nom} ${element.ap1} ${element.ap2}</option>`
      });
      document.getElementById('nom_ope_add').innerHTML = html;
      document.getElementById('nom_ope_up').innerHTML = html;

    },
    error: function (error) {
      console.log(error);
    },
  });
}
GetOperador();
formularioADDRuta.addEventListener("submit", (e) => {
  e.preventDefault();
  let nom_ruta_add = document.getElementById("nom_ruta_add").value;
  let nom_ope_add = document.getElementById("nom_ope_add").value; 
  if (nom_ruta_add.length == 0) {
    Swal.fire("¡Alerta!", "Campo de ruta vacio", "warning");
  } else if (nom_ope_add.length == 0){
    Swal.fire("¡Alerta!", "Campo de Operador vacio", "warning");
  } else {
    $.ajax({
      type: "POST",
      url: "./back/insert_ruta.php",
      data: {
        nom_ruta: nom_ruta_add,
        nom_ope: nom_ope_add
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          $("#tableRutas ").DataTable().ajax.reload();
          Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
          document.getElementById("nom_ruta_add").value = "";
        } else {
          $("#tableRutas ").DataTable().ajax.reload();
          Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
          document.getElementById("nom_ruta_add").value = "";
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
});
//funcion para obtener datos de la fila
const get_info = (id, tipo) => {
  if (tipo == "update") {
    $.ajax({
      type: "POST",
      url: "./back/get_rutaById.php",
      data: {
        id_rut: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_rut_up").value = response.id_rut;
        document.getElementById("nom_rut_up").value = response.nom_rut;
        document.getElementById("nom_ope_up").value = response.id_ope;
      },
      error: function (error) {
        console.log(error);
      },
    });
  } else if (tipo == "delete") {
    $.ajax({
      type: "POST",
      url: "./back/get_rutaById.php",
      data: {
        id_rut: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_rut_de").value = response.id_rut;
        document.getElementById("nom_rut_de").value = response.nom_rut;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
};
/*  funcion para actualizar la informacion */
formularioUpdateRuta.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_rut_up = document.getElementById("id_rut_up").value;
  let nom_rut_up = document.getElementById("nom_rut_up").value;
  let nom_ope_up = document.getElementById("nom_ope_up").value;
  $.ajax({
    type: "POST",
    url: "./back/update_ruta.php",
    data: {
      id_rut: id_rut_up,
      nom_rut: nom_rut_up,
      nom_ope: nom_ope_up,
      accion: "update",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#tableRutas ").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
      } else {
        $("#tableRutas ").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteRuta.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_rut_de = document.getElementById("id_rut_de").value;
  $.ajax({
    type: "POST",
    url: "./back/update_ruta.php",
    data: {
      id_rut: id_rut_de,
      nom_rut: null,
      nom_ope: null,
      accion: "delete",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#tableRutas ").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
      } else {
        $("#tableRutas ").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

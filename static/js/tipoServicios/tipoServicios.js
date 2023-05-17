$(document).ready(function () {
  $("#tablaTipServicios").DataTable({
    ajax: {
      url: "./back/tiposServicios.php",
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
        data: "tipo",
      },
      {
        data: "fec_cre",
      },
      {
        data: "estatus",
      },
      {
        data: "id_tipser",
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

formularioADDTipServicio.addEventListener("submit", (e) => {
  e.preventDefault();
  let tipSerAdd = document.getElementById("tipSerAdd").value;
  if (tipSerAdd.length == 0) {
    Swal.fire("¡Alerta!", "Campo de cargo vacio", "warning");
  } else {
    $.ajax({
      type: "POST",
      url: "./back/tiposServicios.php",
      data: {
        tipoServicio: tipSerAdd,
        tipo: "INSERTAR",
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          $("#tablaTipServicios").DataTable().ajax.reload();
          Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
          document.getElementById("tipSerAdd").value = "";
        } else {
          $("#tablaTipServicios").DataTable().ajax.reload();
          Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
          document.getElementById("tipSerAdd").value = "";
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
      url: "./back/tiposServicios.php",
      data: {
        id: id,
        tipo: "GETBYID",
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("idSerUp").value = response.id_tipser;
        document.getElementById("tipSerUp").value = response.tipo;
      },
      error: function (error) {
        console.log(error);
      },
    });
  } else if (tipo == "delete") {
    $.ajax({
      type: "POST",
      url: "./back/tiposServicios.php",
      data: {
        id: id,
        tipo: "GETBYID",
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("idSerDe").value = response.id_tipser;
        document.getElementById("tipSerDe").value = response.tipo;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
};
/*  funcion para actualizar la informacion */
formularioUpdateCargTipServicioo.addEventListener("submit", (e) => {
  e.preventDefault();
  let idSerUp = document.getElementById("idSerUp").value;
  let tipSerUp = document.getElementById("tipSerUp").value;

  $.ajax({
    type: "POST",
    url: "./back/tiposServicios.php",
    data: {
      id: idSerUp,
      tipoServicio: tipSerUp,
      tipo: "ACTUALIZAR",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#tablaTipServicios").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
      } else {
        $("#tablaTipServicios").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteTipServicioo.addEventListener("submit", (e) => {
  e.preventDefault();
  let idSerDe = document.getElementById("idSerDe").value;
  $.ajax({
    type: "POST",
    url: "./back/tiposServicios.php",
    data: {
      id: idSerDe,
      tipo: "ELIMINAR",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#tablaTipServicios").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "success");
      } else {
        $("#tablaTipServicios").DataTable().ajax.reload();
        Swal.fire("¡Alerta!", `${response.mensaje}`, "error");
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

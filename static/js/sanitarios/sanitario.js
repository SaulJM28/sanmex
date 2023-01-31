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
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" title="Editar" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" title="Eliminar" onclick="get_info(${data}, 'delete'
             )"><i class="fas fa-trash" ></i></button>
             <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalQR" title="Ver Qr" onclick="QR('${row.num_san}', '${row.tip_san}')" ><i class="fas fa-qrcode"></i></button>
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
          <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" title="Editar" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" title="Eliminar" onclick="get_info(${data}, 'delete'
          )"><i class="fas fa-trash" ></i></button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalQR" title="Ver Qr" onclick="QR('${row.num_san}', '${row.tip_san}')" ><i class="fas fa-qrcode"></i></button>
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

//funcion para obtener datos de la fila
const get_info =(id, tipo) => {
  if(tipo == 'update'){
    $.ajax({
      type: "POST",
      url: "./back/get_sanById.php",
      data: {
        id_san: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById('id_san_up').value = response.id_san;
        document.getElementById('num_san_up').value = response.num_san;
        document.getElementById('tip_san_up').value = response.tip_san;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }else if (tipo == 'delete'){
    $.ajax({
      type: "POST",
      url: "./back/get_sanById.php",
      data: {
        id_san: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById('id_san_de').value = response.id_san;
        document.getElementById('num_san_de').value = response.num_san;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

}
/*  funcion para actualizar la informacion */
formularioUpdateSanitario.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_san_up  = document.getElementById('id_san_up').value;
  let num_san_up = document.getElementById('num_san_up').value;
  let tip_san_up = document.getElementById('tip_san_up').value;
  $.ajax({
    type: "POST",
    url: "./back/update_san.php",
    data: {
      id_san: id_san_up,
      num_san: num_san_up,
      tip_san: tip_san_up,
      accion: 'update'
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Mensaje(response.mensaje, "success", "UPDATE");
        cargar_tabla();
        document.getElementById("num_san_up").value  = '';
      } else {
        Mensaje(response.mensaje, "danger", "UPDATE");
        cargar_tabla();
        document.getElementById("num_san_up").value  = '';
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteSanitario.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_san_de  = document.getElementById('id_san_de').value;
  $.ajax({
    type: "POST",
    url: "./back/update_san.php",
    data: {
      id_san: id_san_de,
      num_san: null,
      tip_san: null,
      accion: 'delete'
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

const QR = (num, tipo) => {
    document.getElementById("titleHeaderModalQr").innerHTML = `Codigo QR del sanitario: ${num}` ;
    document.getElementById("imgQR").innerHTML = `<img class="img-fluid" loading="lazy" src ="./back/QRS/qr-san-${num}-${tipo}.png" >`;
    document.getElementById("btnDes").innerHTML = `<a target="_blank" class="btn btn-primary" download="qr-san-${num}-${tipo}.png" href = "./back/QRS/qr-san-${num}-${tipo}.png" >Desacargar QR</a>`;
}

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

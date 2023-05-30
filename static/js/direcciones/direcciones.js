$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#tableDirecciones").DataTable({
    ajax: {
      url: "./back/get_listDire.php",
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
        data: "estado",
      },
      {
        data: "municipio",
      },
      {
        data: "colonia",
      },
      {
        data: "calle",
      },
      {
        data: "num_ext",
      },
      {
        data: "num_int",
      },
      {
        data: "cp",
      },
      {
        data: "coordenadas",
      },
      {
        data: "id_dire",
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
        title: "Lista de direcciones",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de direcciones",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de direcciones",
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
        title: "Lista de direcciones",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de direcciones",
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

formularioADDDireccion.addEventListener("submit", (e) => {
  e.preventDefault();
  let est_dir_add = document.getElementById("est_dir_add").value;
  let mun_dir_add = document.getElementById("mun_dir_add").value;
  let col_dir_add = document.getElementById("col_dir_add").value;
  let call_dir_add = document.getElementById("call_dir_add").value;
  let numext_dir_add = document.getElementById("numext_dir_add").value;
  let numint_dir_add = document.getElementById("numint_dir_add").value;
  let cp_dir_add = document.getElementById("cp_dir_add").value;
  let coord_dir_add = document.getElementById("coord_dir_add").value;
  //poner validaciones de campos
  $.ajax({
    type: "POST",
    url: "./back/insert_dire.php",
    data: {
      estado_add: est_dir_add,
      municipio_add: mun_dir_add,
      colonia_add: col_dir_add,
      calle_add: call_dir_add,
      num_ext_add: numext_dir_add,
      num_int_add: numint_dir_add,
      cp_add: cp_dir_add,
      coordenadas_add: coord_dir_add,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Swal.fire("Alerta", `${response.mensaje}`, "success");
        $("#tableDirecciones ").DataTable().ajax.reload();
        document.getElementById("est_dir_add").value = "";
        document.getElementById("mun_dir_add").value = "";
        document.getElementById("col_dir_add").value = "";
        document.getElementById("call_dir_add").value = "";
        document.getElementById("numext_dir_add").value = "";
        document.getElementById("numint_dir_add").value = "";
        document.getElementById("cp_dir_add").value = "";
        document.getElementById("coord_dir_add").value = "";
      } else {
        Swal.fire("Alerta", `${response.mensaje}`, "danger");
        $("#tableDirecciones ").DataTable().ajax.reload();
        document.getElementById("est_dir_add").value = "";
        document.getElementById("mun_dir_add").value = "";
        document.getElementById("col_dir_add").value = "";
        document.getElementById("call_dir_add").value = "";
        document.getElementById("numext_dir_add").value = "";
        document.getElementById("numint_dir_add").value = "";
        document.getElementById("cp_dir_add").value = "";
        document.getElementById("coord_dir_add").value = "";
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
    afterOpenModal(tipo);
    $.ajax({
      type: "POST",
      url: "./back/get_direById.php",
      data: {
        id_dire: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_dire_up").value = response.id_dire;
        document.getElementById("est_dir_up").value = response.estado;
        document.getElementById("mun_dir_up").value = response.municipio;
        document.getElementById("col_dir_up").value = response.colonia;
        document.getElementById("call_dir_up").value = response.calle;
        document.getElementById("numext_dir_up").value = response.num_ext;
        document.getElementById("numint_dir_up").value = response.num_int;
        document.getElementById("cp_dir_up").value = response.cp;
        document.getElementById("coord_dir_up").value = response.coordenadas;
      },
      error: function (error) {
        console.log(error);
      },
    });
  } else if (tipo == "delete") {
    $.ajax({
      type: "POST",
      url: "./back/get_direById.php",
      data: {
        id_dire: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        document.getElementById("id_dire_de").value = response.id_dire;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
};
/*  funcion para actualizar la informacion */
formularioUPDireccion.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_dire_up = document.getElementById("id_dire_up").value;
  let est_dir_up = document.getElementById("est_dir_up").value;
  let mun_dir_up = document.getElementById("mun_dir_up").value;
  let col_dir_up = document.getElementById("col_dir_up").value;
  let call_dir_up = document.getElementById("call_dir_up").value;
  let numext_dir_up = document.getElementById("numext_dir_up").value;
  let numint_dir_up = document.getElementById("numint_dir_up").value;
  let cp_dir_up = document.getElementById("cp_dir_up").value;
  let coord_dir_up = document.getElementById("coord_dir_up").value;
  $.ajax({
    type: "POST",
    url: "./back/update_dire.php",
    data: {
      id_dire: id_dire_up,
      estado: est_dir_up,
      municipio: mun_dir_up,
      colonia: col_dir_up,
      calle: call_dir_up,
      num_ext: numext_dir_up,
      num_int: numint_dir_up,
      cp: cp_dir_up,
      coordenadas: coord_dir_up,
      accion: "update",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        Swal.fire("Alerta", `${response.mensaje}`, "success");
        $("#tableDirecciones ").DataTable().ajax.reload();
        document.getElementById("id_dire_up").value = "";
        document.getElementById("est_dir_up").value = "";
        document.getElementById("mun_dir_up").value = "";
        document.getElementById("col_dir_up").value = "";
        document.getElementById("call_dir_up").value = "";
        document.getElementById("numext_dir_up").value = "";
        document.getElementById("numint_dir_up").value = "";
        document.getElementById("cp_dir_up").value = "";
        document.getElementById("coord_dir_up").value = "";
      } else {
        Swal.fire("Alerta", `${response.mensaje}`, "danger");
        $("#tableDirecciones ").DataTable().ajax.reload();
        document.getElementById("id_dire_up").value = "";
        document.getElementById("est_dir_up").value = "";
        document.getElementById("mun_dir_up").value = "";
        document.getElementById("col_dir_up").value = "";
        document.getElementById("call_dir_up").value = "";
        document.getElementById("numext_dir_up").value = "";
        document.getElementById("numint_dir_up").value = "";
        document.getElementById("cp_dir_up").value = "";
        document.getElementById("coord_dir_up").value = "";
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
/* funcion para eliminar informacion */
formularioDeleteDireccion.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_dire_de = document.getElementById("id_dire_de").value;
  $.ajax({
    type: "POST",
    url: "./back/update_dire.php",
    data: {
      id_dire: id_dire_de,
      estado: "NULL",
      municipio: "NULL",
      colonia: "NULL",
      calle: "NULL",
      num_ext: "NULL",
      num_int: "NULL",
      cp: "NULL",
      coordenadas: "NULL",
      accion: "delete",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        document.getElementById("id_dire_de").value = "";
        Swal.fire("Alerta", `${response.mensaje}`, "success");
        $("#tableDirecciones ").DataTable().ajax.reload();
      } else {
        document.getElementById("id_dire_de").value = "";
        Swal.fire("Alerta", `${response.mensaje}`, "danger");
        $("#tableDirecciones ").DataTable().ajax.reload();
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

const afterOpenModal = (tipo) => {
  if (tipo == "insert") {
    mapCoord(tipo);
  }
  if (tipo == "update") {
    mapCoord(tipo);
  }
};

const mapCoord = (tipo) => {
  var map;
  var coordnedas;
  var modal;
  if (tipo == "insert") {
    var container = L.DomUtil.get("map");
    if (container != null) {
      container._leaflet_id = null;
      document.getElementById("coord_dir_add").value = '';
    }
    map = L.map(container).setView(
      [20.593085945539304, -100.39036402755565],
      16
    );
    coordnedas = document.getElementById("coord_dir_add");
    modal = new bootstrap.Modal(document.getElementById("myModal"));
  }
  if (tipo == "update") {
    var containerUp = L.DomUtil.get("mapUp");
    if (containerUp != null) {
      containerUp._leaflet_id = null;
    }   
    map = L.map(containerUp).setView(
      [20.593085945539304, -100.39036402755565],
      16
    );
    coordnedas = document.getElementById("coord_dir_up");
    modal = new bootstrap.Modal(document.getElementById("ModalUpdate"));
  }

  const tiles = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);
  var marker = L.marker();
  const popup = L.popup();
  const onMapClick = (e) => {
    coordnedas.value = `${e.latlng.lat} ${e.latlng.lng}`;
    popup
      .setLatLng(e.latlng)
      .setContent(
        `Estas son las coordenadas donde hizo click ${e.latlng.toString()}`
      )
      .openOn(map);
    marker.setLatLng(e.latlng).addTo(map);
  };
  map.on("click", onMapClick);

  modal.show();

  setTimeout(function () {
    map.invalidateSize();
  }, 1000);
};

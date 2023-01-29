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
  
  function cargar_tabla() {
    $("#tableDirecciones").DataTable().clear().destroy();
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
  }
  
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
          Mensaje(response.mensaje, "success", "ADD");
          cargar_tabla();
          document.getElementById("est_dir_add").value = "";
          document.getElementById("mun_dir_add").value = "";
          document.getElementById("col_dir_add").value = "";
          document.getElementById("call_dir_add").value = "";
          document.getElementById("numext_dir_add").value = "";
          document.getElementById("numint_dir_add").value = "";
          document.getElementById("cp_dir_add").value = "";
          document.getElementById("coord_dir_add").value = "";
        } else {
          Mensaje(response.mensaje, "danger", "ADD");
          cargar_tabla();
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
  
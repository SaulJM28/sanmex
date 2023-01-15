$(document).ready(function () {
    //$("#datatable").DataTable();
    $("#tablaUsuarios").DataTable({
      ajax: {
        url: "./back/get_listUsuarios.php",
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
          data: "nom_ope",
        },
        {
          data: "nom_usu",
        },
        {
          data: "pwd_usu",
        },
        {
          data: "tip_usu",
        },
        {
          data: "fec_cre",
        },
        {
          data: "estatus",
        },
        {
          data: "id_usu",
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
          title: "Lista de usuarios",
          text: '<i class="fas fa-file-excel"></i>',
          className: "btn-sm",
        },
        {
          extend: "csvHtml5",
          title: "Lista de usuarios",
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
    $("#tablaUsuarios").DataTable().clear().destroy();
    $("#tablaUsuarios").DataTable({
      ajax: {
        url: "./back/get_listUsuarios.php",
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
          data: "nom_ope",
        },
        {
          data: "nom_usu",
        },
        {
          data: "pwd_usu",
        },
        {
          data: "tip_usu",
        },
        {
          data: "fec_cre",
        },
        {
          data: "estatus",
        },
        {
          data: "id_usu",
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
          title: "Lista de usuarios",
          text: '<i class="fas fa-file-excel"></i>',
          className: "btn-sm",
        },
        {
          extend: "csvHtml5",
          title: "Lista de usuarios",
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
  
  formularioADDUsuario.addEventListener("submit", (e) => {
    e.preventDefault();
    let nom_ope_add = document.getElementById("nom_ope_add").value;
    let nom_uso_add = document.getElementById("nom_uso_add").value;
    let pwd_usu_add = document.getElementById("pwd_usu_add").value;   
    let tip_usu_add = document.getElementById("tip_usu_add").value;
    if(nom_ope_add.length == 0){
        Mensaje("Campo de Operador vacio", "danger", "ADD");
    }else if(nom_uso_add.length == 0){
        Mensaje("Campo de Nombre Usuario vacio", "danger", "ADD");
    }else if(pwd_usu_add.length == 0){
        Mensaje("Campo de Contraseña vacio", "danger", "ADD");
    }else if(tip_usu_add.length == 0){
        Mensaje("Campo de Tipo Usuario vacio", "danger", "ADD");
    }else{
        console.log("todo bien");
    }
    $.ajax({
      type: "POST",
      url: "./back/insert_usuario.php",
      data: {
        nom_ope_add: nom_ope_add,
        nom_uso_add: nom_uso_add,
        pwd_usu_add: pwd_usu_add,
        tip_usu_add: tip_usu_add,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          Mensaje(response.mensaje, "success", "ADD");
          cargar_tabla();
          document.getElementById("nom_ope_add").value;
          document.getElementById("nom_uso_add").value;
          document.getElementById("pwd_usu_add").value;   
          document.getElementById("tip_usu_add").value;
        } else {
          Mensaje(response.mensaje, "danger", "ADD");
          cargar_tabla();
          document.getElementById("nom_ope_add").value;
          document.getElementById("nom_uso_add").value;
          document.getElementById("pwd_usu_add").value;   
          document.getElementById("tip_usu_add").value;
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
        url: "./back/get_usuById.php",
        data: {
          id_usu: id,
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
          document.getElementById("id_usu_up").value = response.id_usu;
          document.getElementById("nombre_ope_up").value = `${response.nom} ${response.ap1} ${response.ap2}`; 
          document.getElementById("nom_usu_up").value = response.nom_usu;
          document.getElementById("pwd_usu_up").value = response.pwd_usu;
          document.getElementById("tip_usu_up").value = response.tip_usu;
        },
        error: function (error) {
          console.log(error);
        },
      });
    } else if (tipo == "delete") {
      $.ajax({
        type: "POST",
        url: "./back/get_usuById.php",
        data: {
          id_usu: id,
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
          document.getElementById("id_usu_de").value = response.id_usu;
          document.getElementById("nom_usu_de").value = `${response.nom} ${response.ap1} ${response.ap2}`;
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  };
  /*  funcion para actualizar la informacion */
  formularioUpdateUsuario.addEventListener("submit", (e) => {
    e.preventDefault();
    let id_usu_up = document.getElementById("id_usu_up").value;
    let nombre_ope_up = document.getElementById("nombre_ope_up").value;
    let nom_usu_up = document.getElementById("nom_usu_up").value;
    let pwd_usu_up = document.getElementById("pwd_usu_up").value;
    let tip_usu_up = document.getElementById("tip_usu_up").value;
    $.ajax({
      type: "POST",
      url: "./back/update_usu.php",
      data: {
        id_usu: id_usu_up,
        nombre_ope: nombre_ope_up,
        nom_usu: nom_usu_up,
        pwd_usu: pwd_usu_up,
        tip_usu: tip_usu_up,
        accion: "update",
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          Mensaje(response.mensaje, "success", "UPDATE");
          cargar_tabla();
          document.getElementById("nombre_ope_up").value = "";
          document.getElementById("nom_usu_up").value = "";
          document.getElementById("pwd_usu_up").value = "";
          document.getElementById("tip_usu_up").value = "";
        } else {
          Mensaje(response.mensaje, "danger", "UPDATE");
          cargar_tabla();
          document.getElementById("nombre_ope_up").value = "";
          document.getElementById("nom_usu_up").value = "";
          document.getElementById("pwd_usu_up").value = "";
          document.getElementById("tip_usu_up").value = "";
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  });
  /* funcion para eliminar informacion */
  formularioDeleteUsuario.addEventListener("submit", (e) => {
    e.preventDefault();
    let id_usu_de = document.getElementById("id_usu_de").value;
    $.ajax({
      type: "POST",
      url: "./back/update_usu.php",
      data: {
        id_usu: id_usu_de,
        nombre_ope: null,
        nom_usu: null,
        pwd_usu: null,
        tip_usu: null,
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
  
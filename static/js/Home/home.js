$(document).ready(function() {
    //$("#datatable").DataTable();
    $("#datatable").DataTable({
        /*     ajax: {
          url: "./back/get_listPesoTalla.php",
          data: { fini: fi, ffin: ff, id_ubic: id_ubi },
          type: "post",
        }, */
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
        dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
        },
        order: [
            [0, "asc"]
        ],
        /*    columns: [
          {
            mRender: function (data, type, row) {
              return row.id_emp.Nombre;
            },
          },
          {
            data: "edad",
          },
          {
            data: "peso",
          },
          {
            data: "talla",
          },
          {
            data: "cintura",
          },
          {
            data: "cadera",
          },
          {
            data: "T_A",
          },
          {
            data: "glucosa",
          },
          {
            mRender: function (data, type, row) {
              return row.IMC.imc;
            },
          },
          {
            mRender: function (data, type, row) {
              return (
                "<p style='text-align:center; font-weight: bold; background-color: " +
                row.IMC.color +
                " '>" +
                row.IMC.texto +
                "</p>"
              );
            },
          },
          {
            data: "porc_gra",
          },
          {
            data: "porc_musc",
          },
          {
            data: "gras_vic",
          },
          {
            data: "MA",
          },
          {
            data: "Met_Bas",
          },
          {
            data: "fecha_regis",
          },
          {
            mRender: function (data, type, row) {
              return row.Ubicacion.nomUbic;
            },
          },
          {
            data: "id_rpt",
            bSortable: false,
            mRender: function (data, type, row) {
              return (
                '<div class="btn-group" role="group">' +
                '<button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm " data-bs-toggle="dropdown" aria-expanded="false"> <i class="fas fa-list"></i> </button>' +
                '<ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">' +
                '<li><a type="button" class="dropdown-item" title="Observaciones de : ' +
                row.id_emp.Nombre +
                '" data-bs-toggle="modal" data-bs-target="#observaciones" onclick="observaciones(' +
                data +
                ')"><i class="far fa-comment"></i> Observaciones</a></li>' +
                '<li><a type="button" class="dropdown-item" title="Editar :  ' +
                row.id_emp.Nombre +
                ' " onclick="get_datos_edit(' +
                data +
                ')"><i class="fa fa-edit"></i> Editar</a></li>' +
                '<li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Eliminar:  ' +
                row.id_emp.Nombre +
                '" onclick="get_datos_elim(' +
                data +
                ')"><i class="fa-solid fa-trash"></i> Eliminar</a></li>' +
                "</ul>" +
                "</div>"
              );
            },
          },
        ], */
        buttons: [{
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
                title: "Lista de usuarios",
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
                title: "Lista de usuarios",
                className: "btn-sm",
                text: '<i class="fa-solid fa-print"></i>',
                footer: "true",
                exportOptions: {
                    columns: ":visible",
                },
            },
            {
                extend: "copy",
                title: "Lista de usuarios",
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

toggleButton.onclick = function() {
    el.classList.toggle("toggled");
};

var options = {
    series: [{
        name: "Sanitarios",
        data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 20, 10, 15]
    }],
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: 'Sanitarios limpiados 2022',
        align: 'center'
    },
    grid: {
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    xaxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

/* GENERADOR DE CODIGO QR */

function generateQRCode(id) {
      let qrcodeContainer2 = document.getElementById("show_qr");
      qrcodeContainer2.innerHTML = "";
      new QRCode(qrcodeContainer2, {
        text: "Sanitario" + id,
        width: 250,
        height: 250,
        colorDark: "#222059",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      });

  }


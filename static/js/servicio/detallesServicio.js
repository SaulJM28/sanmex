window.addEventListener("load", () => {
  get_datos();
  get_infoSanBySer();
});
var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");
toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};
var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var id = urlParams.get("id");

const get_datos = () => {
  $.ajax({
    type: "POST",
    url: "./back/get_servicioDetalleById.php",
    data: {
      id_ser: id,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      /* informacion del cliente */
      document.getElementById("nom_clie").value = response.cliente.nom_clie;
      document.getElementById("raz_soc").value = response.cliente.razon_social;
      document.getElementById("rfc").value = response.cliente.rfc;
      document.getElementById("nom_con").value = response.cliente.nom_con;
      document.getElementById("num_con").value = response.cliente.num_con;
      /* informacion de la direccion */
      document.getElementById("datosDireccion").innerHTML = `
      <div class="row g-0">
      <div class="col-md-4">
          <iframe width="100%" height="100%" frameborder="0" scrolling="no"
              marginheight="0" marginwidth="0" loading="lazy"
              src="https://maps.google.com/maps?width=100%25&amp;height=100%&amp;hl=es&amp;q=${response.direccion.coordenadas}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
      </div>
      <div class="col-md-8">
          <div class="card-body">
              <h5 class="card-title">Direccion del Cliente ${response.cliente.nom_clie}</h5>
              <p class="card-text"><strong>Estado:</strong> ${response.direccion.estado}.</p> 
              <p class="card-text"><strong>Municipio:</strong> ${response.direccion.municipio}.</p>  
              <p class="card-text"><strong>Colonia:</strong> ${response.direccion.colonia}.</p> 
              <p class="card-text"><strong>Calle:</strong> ${response.direccion.calle}.</p> 
              <p class="card-text"><strong>Número Exterior:</strong> ${response.direccion.num_ext}.</p>  
              <p class="card-text"><strong>Número Int:</strong> ${response.direccion.num_int}.</p>  
              <p class="card-text"><strong>CP:</strong> ${response.direccion.cp}.</p> 
          </div>
      </div>
  </div>
      `;
      /* informacion del servicio */
      document.getElementById("id_ser").value = response.id_ser;
      document.getElementById("num_sans").value = response.num_san;
      document.getElementById("cost_unit").value = response.cost_unit;
      document.getElementById("cost_tot").value = response.cost_tot;
      document.getElementById("tip_pag").value = response.tip_pag;
      document.getElementById("dia_pag").value = response.dia_de_pag;
      document.getElementById("dias_serv").value = response.dias_serv;
      document.getElementById("operador").value = response.operador;
      document.getElementById("ruta").value = response.ruta;
      /* titulo del modal */
      document.getElementById("modalTitle").innerHTML = `Nombre del servicio ${response.cliente.razon_social}-${response.cliente.nom_clie}`;
    },
    error: function (error) {
      console.log(error);
    },
  });
};
const get_infoSanBySer = () => {
  $.ajax({
    type: "POST",
    url: "./back/get_listSanByServ.php",
    data: {
      id_ser: id,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      let totalAllenar = document.getElementById("num_sans").value;

      if (response.totalRe >= totalAllenar) {
        document
          .getElementById("btnAddSan")
          .setAttribute("disabled", "disabled");
        document
          .getElementById("btnADDInfoSan")
          .setAttribute("disabled", "disabled");
      }else{
        document
          .getElementById("btnAddSan")
          .removeAttribute("disabled", "disabled");
        document
          .getElementById("btnADDInfoSan")
          .removeAttribute("disabled", "disabled");
      }

      document.getElementById(
        "tittleSanAsig"
      ).innerHTML = `Informacion de los sanitarios asignados ${response.totalRe} de ${totalAllenar}`;
      let html = "";
      response.data.map((element) => {
        console.log(element)
        if (element.estatus_sesa == "FINALIZADO") {
          html += `
          <div class="col-md-4 mt-12">
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
              <div class="card-body">
                <div>
              <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
              <div style="display: flex; justify-content: right;">
                <button class="btn btn-danger btn-sm" onclick="removeSan(${element.id_san}, ${element.id_ser})">Remover <i class="fas fa-trash"></i></button>
                <button 
            class="btn btn-primary btn-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#modalADDSAN" 
            onclick="addSan(${element.id_ser}, ${element.id_sersan})" 
            id = "hola">Agregar Sanitario <i class="fas fa-plus"></i></button>
              </div>
            </div>
              </div>
            </div>
          </div>`;
        } else {
          html += `
          <div class="col-md-4 mt-12">
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
              <div class="card-body">
                <div>
                  <p class="card-text"><strong>Tipo de Sanitario</strong> ${element.tipo} <br>
                  <p class="card-text"><strong>Numero de sanitario asignado:</strong> ${element.num_san} <br>
                    <small class="card-text">Esto lo debe asignar el encargado del almacen</small>
                  </p>
                <div style="display: flex; justify-content: right;">
                <button class="btn btn-danger btn-sm" onclick="removeSanInfo(${element.id_sersan} )">Remover <i class="fas fa-trash"></i></button>
              </div>
            </div>
              </div>
            </div>
          </div>`;
        }
      });
      document.getElementById("infoSanAsig").innerHTML = html;
    },
    error: function (error) {
      console.log(error);
    },
  });
};

function addSan(id_ser, id_sersan) {
  document.getElementById("id_serQr").value = id_ser;
  document.getElementById("id_sersan").value = id_sersan;
  html5QrcodeScanner.render(onScanSuccess);
}

function removeSanInfo(id) {
  $.ajax({
    type: "POST",
    url: "./back/removeSanBySer.php",
    data: {
      id: 0,
      id_ser: 0,
      id_sersan: id,
      tipo: "REMOVERINFO",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        get_infoSanBySer();
        get_datos();
        Swal.fire({
          title: "Alerta",
          text: `${response.mensaje}`,
          icon: "success",
          confirmButtonText: "Aceptar",
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

formularioADDInfoSanServ.addEventListener("submit", (e) => {
  e.preventDefault();
  let precio_san = document.getElementById("precio_san").value;
  let tip_san = document.getElementById("tip_san").value;
  let coord_san = document.getElementById("coord_san").value;
  if (precio_san.length == 0 && tip_san.length == 0 && coord_san.length == 0) {
    Swal.fire({
      title: "Alerta",
      text: `Todos los campos vacios`,
      confirmButtonText: "Aceptar",
    });
  } else {
    $.ajax({
      type: "POST",
      url: "./back/insert_sanser.php",
      data: {
        id_ser: id,
        precio: precio_san,
        tipo: tip_san,
        coord: coord_san,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          get_infoSanBySer();
          get_datos();
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            confirmButtonText: "Aceptar",
          });
        } else {
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            icon: "error",
            confirmButtonText: "Aceptar",
          });
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
});

function finalizarServ() {
  Swal.fire({
    title: "¿Desea finalizar servicio?",
    text: "Al aceptar se liberaran los sanitarios y no podras hacer mas modificaciones",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "./back/finalizarServicio.php",
        data: {
          id_ser: id,
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
          if (response.resultado == true) {
            get_infoSanBySer();
            Swal.fire("Alerta", `${response.mensaje}`, "success");
          } else {
            get_infoSanBySer();
            Swal.fire("Alerta", `${response.mensaje}`, "success");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
      /* poner el ajax */
    }
  });
}

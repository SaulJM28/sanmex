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
    },
    error: function (error) {
      console.log(error);
    },
  });
};

const get_infoSanBySer = () =>{
  $.ajax({
    type: "POST",
    url: "./back/get_listSanByServ.php",
    data: {
      id_ser: id,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {      

      let html = '';
      response.map((element) => { 
        if (element.sans_rent == null) {
          totalAllenar = 0;
        } else {
          totalAllenar = element.sans_rent;
        }

        if(element.totalRe >= totalAllenar){
          document.getElementById("btnAddSan").setAttribute("disabled", "disabled");
        }else {
          document.getElementById("btnAddSan").removeAttribute("disabled", "disabled");
        }
          
        document.getElementById("tittleSanAsig").innerHTML = `Informacion de los sanitarios asignados ${element.totalRe} de ${totalAllenar}`;
        

        if(element.estatus == "FINALIZADO"){
          html += `
          <div class="col-md-4 mt-12">  
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tip_san}">
              <div class="card-body">
                  <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
                  <p class="card-text"><strong>Tipo de sanitario:</strong> ${element.tip_san}</p>
                  <div style="display: flex; justify-content: right;">
                  <button class="btn btn-danger" data-bs-toggle="modal" disabled data-bs-target="#modalREMOVESAN" onclick="removeSan(${element.num_san})">Remover <i class="fas fa-times"></i></button>
                  </div>
              </div>
            </div>
          </div>`;
        }else{
          html += `
          <div class="col-md-4 mt-12">
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tip_san}">
              <div class="card-body">
                  <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
                  <p class="card-text"><strong>Tipo de sanitario:</strong> ${element.tip_san}</p>
                  <div style="display: flex; justify-content: right;">
                  <button class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#modalREMOVESAN" onclick="removeSan(${element.num_san})">Remover <i class="fas fa-times"></i></button>
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

function removeSan (id) {
  document.getElementById('id_san_re').value = id;
}

formularioREMOVESanServ.addEventListener("submit", (e) =>{
  e.preventDefault();
  let id_san_re = document.getElementById("id_san_re").value;
  $.ajax({
    type: "POST",
    url: "./back/removeSanBySer.php",
    data: {
      id_san: id_san_re,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if(response.resultado == true){
        get_infoSanBySer();
        Swal.fire({
          title: 'Alerta',
          text: `${response.mensaje}`,
          icon: 'success',
          confirmButtonText: 'Aceptar'
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});

/* ESCANEAR QR DE SANITARIO */
function onScanSuccess(decodedText, decodedResult) {
  $.ajax({
    type: "POST",
    url: "./back/disponibilidadSan.php",
    data: {
      id_san: decodedText,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true){
        Swal.fire({
          title: 'Alerta',
          text: `${response.mensaje}`,
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      }else{
        $.ajax({
          type: "POST",
          url: "./back/get_sanitarioById.php",
          data: {
            num_san: decodedText,
          },
          async: true,
          beforeSend: function () {},
          success: function (response) {
            if(response.resultado == true){
              document.getElementById('botonADDSan').disabled = false;
              document.getElementById("id_san").value = response.id_san;
              document.getElementById("num_san").value = response.num_san;
              document.getElementById("tip_san").value = response.tip_san;
            }else{
              Swal.fire({
                title: 'Error!',
                text: `${response.mensaje}`,
                icon: 'error',
                confirmButtonText: 'Aceptar'
              });
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      }
      
    },
    error: function (error) {
      console.log(error);
    },
  });
  
}
var html5QrcodeScanner = new Html5QrcodeScanner(
  "qr-reader", { fps: 10, qrbox: 200 });
html5QrcodeScanner.render(onScanSuccess);

/* This function send data by method POST to file PHP */

formularioADDSanServ.addEventListener("submit", (e) =>{
  e.preventDefault();
  let id_san = document.getElementById("id_san").value; 
  let id_ser = document.getElementById("id_ser").value;
  $.ajax({
    type: "POST",
    url: "./back/insert_sersan.php",
    data: {
      id_san: id_san,
      id_ser: id_ser,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {  
      if(response.resultado == true){
        get_infoSanBySer();
        Swal.fire({
          title: 'Alerta',
          text: `${response.mensaje}`,
          confirmButtonText: 'Aceptar'
        });
      } else {
        Swal.fire({
          title: 'Alerta',
          text: `${response.mensaje}`,
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});


function finalizarServ() {
  Swal.fire({
    title: '¿Desea finalizar servicio?',
    text: "Al aceptar se liberaran los sanitarios y no podras hacer mas modificaciones",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar'
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
          if(response.resultado == true){
            Swal.fire(
              'Alerta',
              `${response.mensaje}`,
              'success'
            )
          }else{
            Swal.fire(
              'Alerta',
              `${response.mensaje}`,
              'success'
            )
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


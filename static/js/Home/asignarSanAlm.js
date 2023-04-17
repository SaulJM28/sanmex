window.addEventListener("load", () => {         
    get_infoSanBySer();
  });
  var el = document.getElementById("wrapper");
  var toggleButton = document.getElementById("menu-toggle");
  toggleButton.onclick = function () {
    el.classList.toggle("toggled");
  };
  var queryString = window.location.search;
  var urlParams = new URLSearchParams(queryString);
  var id = urlParams.get("id_ser");
  var san_sol = urlParams.get("san_sol");
  

  const get_infoSanBySer = () => {
    $.ajax({
      type: "POST",
      url: "./src/servicios/back/get_listSanByServ.php",
      data: {
        id_ser: id,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        let totalRe = response.totalRe;        
        document.getElementById("titleSanSer").innerHTML = `<h1 style = "text-align: center;">Sanitarios Asignados ${totalRe} de ${san_sol} </h1>`
        let html = "";
        response.data.map((element) => {
          console.log(element);
          if (element.estatus_ser == "FINALIZADO") {
            html += `
            <div class="col-md-12 mt-12">
              <div class="card sombra" style = "border-left: 5px solid  ${element.color}">
                <img src="./static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
                <div class="card-body">
                <div>
                <p class="card-text"><strong>Tipo de Sanitario Solicitado:</strong> ${element.tipo}</p>
                <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
                <div style="display: flex; justify-content: right;">
                  El servicio ha finalizado
                </div>
              </div>
                </div>
              </div>
            </div>`;

          } else {
            //validamos que ya se haya registrado un sanitario
            if (element.id_san != "Sin sanitario asignado") {
              html += `
              <div class="col-md-12 mt-12">
                <div class="card sombra" style = "border-left: 5px solid  ${element.color}">
                  <img src="./static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
                  <div class="card-body">
                  <div>
                  <p class="card-text"><strong>Tipo de Sanitario Solicitado:</strong> ${element.tipo}</p>
                  <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
                  <div style="display: flex; justify-content: right;">
                    <button class="btn btn-danger btn-sm" onclick="removeSan(${element.id_san}, ${element.id_ser}, ${element.id_sersan})">Remover <i class="fas fa-trash"></i></button>
                  </div>
                </div>
                  </div>
                </div>
              </div>`;
            }else{
              html += `
              <div class="col-md-12 mt-12">
                <div class="card sombra" style = "border-left: 5px solid  ${element.color}">
                  <img src="./static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
                  <div class="card-body">
                  <div>
                  <p class="card-text"><strong>Tipo de Sanitario Solicitado:</strong> ${element.tipo}</p>
                  <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
                  <div style="display: flex; justify-content: right;">
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
            }
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
     
  function removeSan(id, id_ser, id_sersan) {
    $.ajax({
      type: "POST",
      url: "./src/servicios/back/removeSanBySer.php",
      data: {
        id: id,
        id_ser: id_ser,
        id_sersan: id_sersan,
        tipo: "REMOVERSAN",
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          get_infoSanBySer();
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
  
  /* ESCANEAR QR DE SANITARIO */
  var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
    fps: 10,
    qrbox: 200,
  });
  
  function onScanSuccess(decodedText, decodedResult) {
    html5QrcodeScanner.clear();
    $.ajax({
      type: "POST",
      url: "./src/servicios/back/disponibilidadSan.php",
      data: {
        id_san: decodedText,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          $("#modalADDSAN").modal("hide");
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            icon: "error",
            confirmButtonText: "Aceptar",
          });
        } else {
          $.ajax({
            type: "POST",
            url: "./src/servicios/back/get_sanitarioById.php",
            data: {
              num_san: decodedText,
            },
            async: true,
            beforeSend: function () {},
            success: function (response) {
              if (response.resultado == true) {
                Swal.fire({
                  title: "Alerta",
                  text: `Codigo Qr escaneado Correctamente`,
                  icon: "success",
                  confirmButtonText: "Aceptar",
                });
                document.getElementById("botonADDSan").disabled = false;
                document.getElementById("id_san").value = response.id_san;
                document.getElementById("num_san").value = response.num_san;
                document.getElementById("tip_sanQR").value = response.tip_san;
              } else {
                $("#modalADDSAN").modal("hide");
                Swal.fire({
                  title: "Error!",
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
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
  
  
  /* This function send data by method POST to file PHP */
  
  formularioADDSanServ.addEventListener("submit", (e) => {
    e.preventDefault();
    let id_san = document.getElementById("id_san").value;
    let id_ser = document.getElementById("id_serQr").value;
    let id_sersan = document.getElementById("id_sersan").value;
    let tipo =  document.getElementById("tip_sanQR").value;
    $.ajax({
      type: "POST",
      url: "./src/servicios/back/insert_sersan.php",
      data: {
        id_san: id_san,
        id_ser: id_ser,
        id_sersan: id_sersan,
        tipo: tipo
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          $("#modalADDSAN").modal("hide");
          get_infoSanBySer();
          document.getElementById("id_san").value = "";
          document.getElementById("id_serQr").value = "";
          document.getElementById("id_sersan").value = "";
          document.getElementById("num_san").value = "";
          document.getElementById("tip_sanQR").value = "";
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            confirmButtonText: "Aceptar",
          });
        } else {
          $("#modalADDSAN").modal("hide");
          get_infoSanBySer();
          document.getElementById("id_san").value = "";
          document.getElementById("id_serQr").value = "";
          document.getElementById("id_sersan").value = "";
          document.getElementById("num_san").value = "";
          document.getElementById("tip_sanQR").value = "";
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
  });
  

  
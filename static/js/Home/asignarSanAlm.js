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
        document.getElementById("titleSanSer").innerHTML = `<h1 style = "text-align: center;">Sanitarios solicitados ${san_sol} </h1>`
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

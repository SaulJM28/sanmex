var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

addEventListener("load", () => {
 let nom_usu = document.getElementById("nom_usu").value;
  $.ajax({
    type: "POST",
    url: "./back/get_listSerReaByUsu.php",
    data: {
      nom_usu: nom_usu,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      let html = "";
      response.data.map((element) => {
        html += `
        <div class="card sombra" style="width: 100%; border-left: 5px solid ${element.color}">
          <div class="card-body">
            <h5 class="card-title text-center">Informacion del servicio realizado <i class = '${element.icono}' ></i> </h5>
            <p class="card-text"><strong>Servicio: </strong> ${element.servicio}. <strong>Cliente: </strong> ${element.cliente}.</p>
            <p class="card-text"><strong>Sanitario: </strong> ${element.sanitario}.</p>
            <p class="card-text"><strong>Comentarios: </strong> ${element.comentario}.</p>
              <div style = "display: flex; justify-content: right;">
                <p class="card-text"><strong>Fecha: </strong> ${element.fecha}.</p>
              </div>
          </div>
        </div><br>
        `;
      });
      document.getElementById("itemListServs").innerHTML = html;
    },
    error: function (error) {
      console.log(error);
    },
  });
});

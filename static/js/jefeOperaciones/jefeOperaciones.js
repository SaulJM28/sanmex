var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");
toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var id = urlParams.get("id_ser");

var map = L.map("map").setView([20.577016352557045, -100.28552751620585], 16);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

$.ajax({
  type: "POST",
  url: "../servicios/back/get_listSanByServ.php",
  data: {
    id_ser: id,
  },
  async: true,
  beforeSend: function () {},
  success: function (response) {
    if (response.result == true) {
      response.data.forEach((element) => {
        var coord = element.coord;
        var partes = coord.split(",");
        var marker = L.marker([partes[0], partes[1]]).addTo(map);
        marker.bindPopup("Direccion: " + element.direccionEntrega);
      });
    } else {
    }
  },
  error: function (error) {
    console.log(error);
  },
});

$.ajax({
  type: "GET",
  url: "../rutas/back/get_listRutas.php",
  async: true,
  beforeSend: function () {},
  success: function (response) {
    let html = `<option value = "" selected>Seleccione una ruta</option>`;
    response.data.forEach((element) => {
      html += `<option value = "${element.id_rut}">${element.nom_rut}</option>`;
    });
    document.getElementById("ruta").innerHTML = html;
  },
  error: function (error) {
    console.log(error);
  },
});

formularioAddRuta.addEventListener("submit", (e) => {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target));
  var diasSeleccionados = $("input[name='dias[]']:checked")
    .map(function () {
      return this.value;
    })
    .get();
   $.ajax({
    type: "POST",
    url: "../servicios/back/insert_rutser.php",
    data: {
      id_ser: id,
      id_rut: data.ruta,
      dias: diasSeleccionados
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if(response.resultado == true){
        Swal.fire("Alerta", `${response.mensaje}`, "success");
        document.getElementById("formularioAddRuta").reset();
      }else{
        Swal.fire("Alerta", `${response.mensaje}`, "error");
        document.getElementById("formularioAddRuta").reset();
      }
    },
    error: function (error) {
      console.log(error);
    },
  }); 
});

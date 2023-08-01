let el = document.getElementById("wrapper");
let toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var id = urlParams.get("id");

$.ajax({
  type: "POST",
  url: "./back/getlistSanBySer.php",
  data: {
    id_ser: id,
  },
  dataType: "JSON",
  success: function (response) {
    var html = '';
    response.map((element) => {
      html += `
              <div class="col-lg-4 col-md-12 col-sm-12 my-1 py-1">
                <div class="card">
                  <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-">
                  <div class="card-body">
                    <div>
                      <p class="card-text"><strong>Tipo de Sanitario solicitado: </strong>${element.tipo}</p>
                      <div>
                    </div>
                    <div class = "d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm" onclick = "realizarSerLimp(${element.id_ser})" >Realizar</button>
                  </div>
                </div>
                  </div>
                </div>
              </div>`;
    });
    document.getElementById("contenedor").innerHTML = html;
  },
});

function realizarSerLimp(id){
  window.location.href = `reaSerLimSan.php?id=${id}`;
}

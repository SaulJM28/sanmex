let el = document.getElementById("wrapper");
let toggleButton = document.getElementById("menu-toggle");
let limite = 0;
let servicios = "";
let ultimoServicio;

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

/* creamos el observador */
let observador = new IntersectionObserver(
  (entradas, observador) => {
    entradas.forEach((entrada) => {
      if (entrada.isIntersecting) {
        limite = limite + 10;
        cargarServicios();
      }
    });
  },
  {
    rootMargin: "0px 0px 200px 0px",
    threshold: 1.0,
  }
);

const cargarServicios = async () => {
  try {
    const respuesta = await fetch(
      `./back/getListSerReaOpeA.php?limite=${limite}`
    );
    // Si la respuesta es correcta
    if (respuesta.status === 200) {
      const datos = await respuesta.json();
      if (datos.resultado == false) {
        document.getElementById("contenedor").innerHTML += `<p class = "text-center">${datos.mensaje}<p>`;
      }
      if (datos.resultado == true) {
        datos.data.forEach((element) => {
          document.getElementById(
            "nomOpeList"
          ).innerHTML = `${element.operador}`;
          if (element.estatus == "REALIZADO") {
            color = `${element.color}`;
          } else if (element.estatus == "INCIDENCIA") {
            color = `${element.color}`;
          }
          servicios += `
                      <div class="card sombra" style = "margin-top: 10px; border-left: 5px solid  ${color}">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <h5 class="card-title">Numero de servicio: ${element.servicio}</h5>
                            </div>
                              <ul class="list-group">
                              <li class="list-group-item bg-white"><strong>Cliente:</strong> ${element.cliente}. </li>
                              <li class="list-group-item bg-white"><strong>Comentario:</strong> ${element.comentario}. </li>
                              <li class="list-group-item bg-white"><strong>Tipo de servicio:</strong> ${element.tip_ser}. </li>
                              <li class="list-group-item bg-white"><strong>Estatus:</strong> ${element.estatus}. </li>
                            </ul>
                          </div>
                      </div>
          `;
        });
        document.getElementById("contenedor").innerHTML = servicios;

        if (limite <= datos.data[0].totalRe) {
          if (ultimoServicio) {
            observador.unobserve(ultimoServicio);
          }
          const serviciosEnPantalla = document.querySelectorAll(
            ".contenedor .sombra"
          );
          ultimoServicio = serviciosEnPantalla[serviciosEnPantalla.length - 1];
          observador.observe(ultimoServicio);
        }
      }
    } else if (respuesta.resultado === false) {
      console.log("no hay resultados");
    }
  } catch (error) {
    console.log(error);
    document.getElementById(
      "contenedor"
    ).innerHTML += `<p class = "text-center">Ya no hay servicios<p>`;
  }
};
cargarServicios();


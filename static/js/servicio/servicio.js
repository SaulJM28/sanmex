var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get('id_ser')

if(navigator.geolocation){
    var success = function(position){
    let coordenadas = `${position.coords.latitude}, ${position.coords.longitude}`; 
    }
    navigator.geolocation.getCurrentPosition(success, function(msg){
    console.error( msg );
    });
    }
toggleButton.onclick = function() {
    el.classList.toggle("toggled");
};

function onScanSuccess(decodedText, decodedResult) {
    $.ajax({
        type: "POST",
        url: "./include/getInfoServicio.php",
        data: {
          num_san: decodedText,
          id_ser: id
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
            if(response.resultado == true){
                Swal.fire({
                    title: 'Alerta',
                    text: 'Sanitario encontrado',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                  });
                  document.getElementById("nom_clieView").innerHTML = `<strong>Nombre del cliente:</strong> ${response.nom_clie}.`;
                  document.getElementById("raz_socView").innerHTML = `<strong>Razon Social:</strong> ${response.razon_social}.`;
                  document.getElementById("rfc_view").innerHTML = `<strong>RFC:</strong> ${response.rfc}.`;
                  document.getElementById("estadoView").innerHTML = `<strong>Estado:</strong> ${response.estado}.`;
                  document.getElementById("municipioView").innerHTML = `<strong>Municipio:</strong> ${response.municipio}.`;
                  document.getElementById("coloniaView").innerHTML = `<strong>Colonia:</strong> ${response.colonia}.`;
                  document.getElementById("calleView").innerHTML = `<strong>Calle:</strong> ${response.calle}.`;
                  document.getElementById("num_sanView").innerHTML = `<strong>Numero de sanitario:</strong>  ${response.num_san}.`;
                  document.getElementById("tip_sanView").innerHTML = `<strong>Tipo:</strong>. ${response.tip_san}`;
                  document.getElementById("servicioADD").value = `${response.razon_social}-${response.colonia}-${response.calle}`;
                  document.getElementById("clienteADD").value = `${response.nom_clie}`;
                  document.getElementById("sanitarioADD").value = `${response.num_san}`;
            }else if(response.resultado == false){
                Swal.fire({
                    title: 'Alerta',
                    text: 'No se pudo encontrar el numero de sanitario',
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
var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 200 });
html5QrcodeScanner.render(onScanSuccess);

/* funcion para agregar a la bitacora */

formularioADDSerBit.addEventListener("submit", (e) => {
    e.preventDefault();
    let operadorADD = document.getElementById("operadorADD").value;
    let servicioADD = document.getElementById("servicioADD").value; 
    let clienteADD = document.getElementById("clienteADD").value; 
    let sanitarioADD = document.getElementById("sanitarioADD").value; 
    let coordADD = document.getElementById("coordADD").value;
    let comentarioADD = document.getElementById("comentarioADD").value;
    let evidenciaADD = document.getElementById("evidenciaADD").value;
    
    if(sanitarioADD.length == 0){
        Swal.fire({
            title: 'Alerta',
            text: 'Para continuar escanea el QR del sanitario',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          });
    }else{
        formularioADDSerBit.submit();
    }
});

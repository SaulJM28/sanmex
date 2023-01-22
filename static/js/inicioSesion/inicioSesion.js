formularioIniciarSesion.addEventListener("submit", (e) => {
    e.preventDefault();

    let nom_usu = document.getElementById("nom_usu").value;
    let pwd = document.getElementById("pwd").value;
    
    if(nom_usu == ""){
        Mensaje("Campo <strong>Nombre de usuario vacio</strong>.", "danger")
    }else if (pwd == ""){
        Mensaje("Campo <strong>Contraseña</strong>.", "danger")
    }else {
       // Mensaje("Todos los campos estan llenos, esperando repuesta del servidor", "success");
        $.ajax({
            type: "POST",
            url: "include/login.php",
            data: {
                username: nom_usu,
                password: pwd,
            },
            async: true,
            beforeSend: function () {},
            success: function (response) {
                console.log(response);
            if (response.resultado == true) {
                Mensaje(response.mensaje, "success");
                window.location.href = `${response.url}`;
              } else {
                Mensaje(response.mensaje, "danger");
              }
            },
            error: function (error) {
              console.log(error);
            },
          });
    }
});

function Mensaje(mensaje, color){
document.getElementById("mensaje").innerHTML = `<div class="alert alert-${color} alert-dismissible fade show" role="alert">
<strong>¡Aviso!</strong> ${mensaje}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`
}
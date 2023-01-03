formularioIniciarSesion.addEventListener("submit", (e) => {
    e.preventDefault();

    let nom_usu = document.getElementById("nom_usu").value;
    let pwd = document.getElementById("pwd").value;
    
    if(nom_usu == ""){
        Mensaje("Campo <strong>Nombre de usuario vacio</strong>.", "danger")
    }else if (pwd == ""){
        Mensaje("Campo <strong>Contraseña</strong>.", "danger")
    }else {
        Mensaje("Todos los campos estan llenos, esperando repuesta del servidor", "success");
    }
});

function Mensaje(mensaje, color){
document.getElementById("mensaje").innerHTML = `<div class="alert alert-${color} alert-dismissible fade show" role="alert">
<strong>¡Aviso!</strong> ${mensaje}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`
}
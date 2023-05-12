<?php 
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "ADMINISTRADOR"){
    echo '<div class="fondo__sidebar" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold ">Sanitarios</a>
        <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
        <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold ">Usuarios</a>
        <a href="../../src/tipoUsuarios/tipoUsuario.php" class="list-group-item list-group-item-action second-text fw-bold ">Tipo de Usuario</a>
        <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold ">Direcciones</a>
        <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
        <a href="../../src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
        <a href="../../src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
        <a href="../../src/rutas/listaRutas.php" class="list-group-item list-group-item-action second-text fw-bold">Rutas</a>
        <a href="../../include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
    </div>
</div>';
}

if(isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "OPERADOR"){
    echo '<div class="fondo__sidebar" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="listaServicios.php" class="list-group-item list-group-item-action second-text fw-bold ">Servicios</a>
        <a href="../../src/serviciosRea/servicios_rea.php" class="list-group-item list-group-item-action second-text fw-bold ">Servicios Realizados</a>
        <a href="./include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
    </div>
</div>';
}

?>
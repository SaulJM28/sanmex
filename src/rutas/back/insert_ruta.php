<?php
if (!$_POST) {
    header('HTTP/1.1 400 Bad Request');
} else {
    header('Content-Type: application/json; charset=utf-8');
    header('HTTP/1.1 200 OK');
    $nom_ruta  = $_POST['nom_ruta'];
    $nom_ope = $_POST['nom_ope'];

    date_default_timezone_set('america/mexico_city');
    $hoy = date('Y-m-d h:i:s');

    include("../../../include/conexion.php");
    $sql = " INSERT INTO `rutas` (`id_rut`, `nom_rut`, `id_ope`, `fec_reg`, `estatus`) VALUES (NULL, '$nom_ruta', '$nom_ope', '$hoy', 'ACTIVO');";
    $resultado = mysqli_query($enlace, $sql);

    if (!$resultado) {
        echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        $data = array(
            "resultado" => false,
            "mensaje" => "No se pudo hacer el registro",
            "url" => "../sanitarios.php"
        );
    } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Registro insertado correctamente",
            "url" => "../sanitarios.php"
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

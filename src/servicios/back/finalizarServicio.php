<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_ser = $_POST['id_ser'];
    include("../../../include/conexion.php");
    /* in this we need to do the update in the table sanitarios */
    $queryUpdate = "UPDATE servicio_sani set estatus = 'FINALIZADO' WHERE id_ser = '$id_ser'";
    $resultUpdate = mysqli_query($enlace, $queryUpdate);
    if (!$resultUpdate) {
        echo "Error: " . $queryUpdate . "<br>" . mysqli_error($enlace);
        $data = array(
            "resultado" => false,
            "mensaje" => "Ocurrio un error",
            "url" => "../sanitarios.php"
        );
    } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Servicio finalizado correctamente",
            "url" => "../sanitarios.php"
        );
    }
    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
?>
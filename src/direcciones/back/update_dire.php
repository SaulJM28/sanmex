<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    $id_dire = $_POST['id_dire'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $num_ext = $_POST['num_ext'];
    $num_int = $_POST['num_int'];
    $cp = $_POST['cp'];
    $coordenadas = $_POST['coordenadas'];
    $accion = $_POST['accion'];

    if ($accion == 'update') {
        include("../../../include/conexion.php");
        $sql = "UPDATE direcciones SET estado = '$estado' , municipio = '$municipio', colonia = '$colonia', calle = '$calle', num_ext = '$num_ext', num_int = '$num_int', cp = '$cp', coordenadas = '$coordenadas'  WHERE id_dire = '$id_dire';";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            header('Content-Type: application/json; charset=utf-8');
            $data = array(
                "resultado" => false,
                "mensaje" => "Error: " . $sql . "<br>" . mysqli_error($enlace)
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            header('Content-Type: application/json; charset=utf-8');
            $data = array(
                "resultado" => true,
                "mensaje" => "Información actualizada correctamente."
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        }
    } else if ($accion == 'delete'){
        include("../../../include/conexion.php");
        $sql = "UPDATE direcciones SET estatus = 'INACTIVO'  WHERE id_dire = '$id_dire';";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            header('Content-Type: application/json; charset=utf-8');
            $data = array(
                "resultado" => false,
                "mensaje" => "Error: " . $sql . "<br>" . mysqli_error($enlace)
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            header('Content-Type: application/json; charset=utf-8');
            $data = array(
                "resultado" => true,
                "mensaje" => "Información eliminada correctamente."
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}

<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    header('Content-Type: application/json; charset=utf-8');
    include("../../../include/conexion.php");
    $id_ser = $_POST['id_ser'];
    $id_rut = $_POST['id_rut'];
    $dias = $_POST['dias'];
    $diasSeparados = implode(', ', $dias);
    // Realizar las operaciones necesarias con los días seleccionados
    $sql = "UPDATE servicio SET 
        id_rut = '$id_rut',
        dias_serv = '$diasSeparados'
        WHERE id_ser = '$id_ser';";
    $resultado = mysqli_query($enlace, $sql);
    if (!$resultado) {
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
            "mensaje" => "Ruta agregada correctamente"
        );
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_san = $_POST['id_san'];
    $id_ser = $_POST['id_ser'];
    $id_sersan = $_POST['id_sersan'];
    $tipo = $_POST['tipo'];

    include("../../../include/conexion.php");
    //validamos que el tipo de sanitario coincidan
    $tipoSan = "SELECT tipo FROM servicio_sani WHERE id_sersan = '$id_sersan';";
    $resultadoTipoSan = mysqli_query($enlace, $tipoSan);
    if (mysqli_num_rows($resultadoTipoSan) > 0) {
        // Recorrer los resultados y mostrarlos
        while ($fila = mysqli_fetch_assoc($resultadoTipoSan)) {
            if ($tipo == $fila['tipo']) {
                $coincidencia = true;
            } else {
                $coincidencia = false;
            }
        }
    } else {
        echo "Error: " . $tipoSan . "<br>" . mysqli_error($enlace);
    }
    if (!$coincidencia) {
        $data = array(
            "resultado" => false,
            "mensaje" => "El tipo de sanitario con coincide con el solicitado",
            "url" => "../sanitarios.php"
        );
    } else {
        $sql = "UPDATE servicio_sani SET id_san = '$id_san' WHERE id_sersan = '$id_sersan';";
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
                "mensaje" => "Sanitario insertado correctamente insertado correctamente",
                "url" => "../sanitarios.php"
            );
        }
    }
    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
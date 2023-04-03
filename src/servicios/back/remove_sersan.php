<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_san = $_POST['id_san'];
    $id_ser = $_POST['id_ser'];
    $id_sersan = $_POST['id_sersan'];

    include("../../../include/conexion.php");
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
    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

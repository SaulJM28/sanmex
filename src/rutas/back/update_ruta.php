<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    $id_rut = $_POST['id_rut'];
    $nom_rut = $_POST['nom_rut'];
    $nom_ope = $_POST['nom_ope'];
    $accion = $_POST['accion'];

    if ($accion == 'update') {
        include("../../../include/conexion.php");
        $sql = "UPDATE rutas SET 
        nom_rut = '$nom_rut',
        id_ope = '$nom_ope'
        WHERE id_rut = '$id_rut';";
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
        $sql = "UPDATE rutas SET estatus = 'INACTIVO'  WHERE id_rut = '$id_rut';";
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

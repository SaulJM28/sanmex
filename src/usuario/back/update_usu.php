<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    $id_usu = $_POST['id_usu'];
    $nombre_ope = $_POST['nombre_ope'];
    $nom_usu = $_POST['nom_usu'];
    $pwd_usu = $_POST['pwd_usu'];
    $tip_usu = $_POST['tip_usu'];
    $accion = $_POST['accion'];

    if ($accion == 'update') {
        include("../../../include/conexion.php");
        $sql = "UPDATE usuarios SET nom_usu = '$nom_usu' , pwd_usu = '$pwd_usu', tip_usu = '$tip_usu'  WHERE id_usu = '$id_usu';";
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
        $sql = "UPDATE usuarios SET estatus = 'INACTIVO'  WHERE id_usu = '$id_usu';";
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

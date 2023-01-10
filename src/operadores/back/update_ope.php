<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    $id_ope_up = $_POST['id_ope'];
    $nombre_ope_up = $_POST['nombre_ope'];
    $ap1_ope_up = $_POST['ap1_ope'];
    $ap2_ope_up = $_POST['ap2_ope'];
    $tel_op_up = $_POST['tel_op'];
    $accion = $_POST['accion'];

    if ($accion == 'update') {
        include("../../../include/conexion.php");
        $sql = "UPDATE operadores SET nom = '$nombre_ope_up' , ap1 = '$ap1_ope_up', ap2 = '$ap2_ope_up', tel = '$tel_op_up'  WHERE id_ope = '$id_ope_up';";
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
        $sql = "UPDATE operadores SET estatus = 'INACTIVO'  WHERE id_ope = '$id_ope_up';";
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

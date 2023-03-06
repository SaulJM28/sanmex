<?php
if (!$_POST) {
    echo "Don't exist method post";
} else {
    $id = $_POST['id'];
    $nom_clie = $_POST['nom_clie'];
    $tel_clie = $_POST['tel_clie'];
    $rfc_clie = $_POST['rfc_clie'];
    $razsoc_clie = $_POST['razsoc_clie'];
    $nomcon_clie = $_POST['nomcon_clie'];
    $numtel_clie = $_POST['numtel_clie'];
    $accion = $_POST['accion'];

    if ($accion == 'update') {
        include("../../../include/conexion.php");
        $sql = "UPDATE clientes SET 
        nom_clie = '$nom_clie',
        tel_clie = '$tel_clie',
        rfc = '$rfc_clie', 
        razon_social = '$razsoc_clie', 
        nom_con = '$nomcon_clie',  
        num_con = '$numtel_clie'
        WHERE id_clie = '$id';";
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
        $sql = "UPDATE clientes SET estatus = 'INACTIVO'  WHERE id_clie = '$id';";
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

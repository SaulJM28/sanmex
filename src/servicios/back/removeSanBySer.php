<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_san = $_POST['id_san'];
    include("../../../include/conexion.php");       
        $sql = "DELETE FROM servicio_sani WHERE id_san = '$id_san';";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
            $data = array(
                "resultado" => false,
                "mensaje" => "No se pudo remover el sanitario",
                "url" => "../sanitarios.php"
            );
        } else {
            /* in this we need to do the update in the table sanitarios */
            $queryUpdate = "UPDATE sanitarios set estatus = 'DISPONIBLE' WHERE id_san = '$id_san'";
            $resultUpdate = mysqli_query($enlace, $queryUpdate);
            if (!$resultUpdate) {
                echo "Error: " . $queryUpdate . "<br>" . mysqli_error($enlace);
                $data = array(
                    "resultado" => false,
                    "mensaje" => "No se pudo remover el sanitario",
                    "url" => "../sanitarios.php"
                );
            } else {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Sanitario removido correctamente",
                    "url" => "../sanitarios.php"
                );
            }
        }
    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
?>
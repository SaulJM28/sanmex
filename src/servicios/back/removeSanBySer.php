<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    include("../../../include/conexion.php");
    header('Content-Type: application/json; charset=utf-8');
    $tipo = $_POST['tipo'];
    $id = $_POST['id'];
    $id_ser = $_POST['id_ser'];
    $id_sersan = $_POST['id_sersan'];

    if ($tipo == 'REMOVERINFO') {
        $queryUpdate = "DELETE FROM servicio_sani WHERE id_sersan = '$id_sersan'";
        $resultUpdate = mysqli_query($enlace, $queryUpdate);
        if (!$resultUpdate) {
            echo "Error: " . $queryUpdate . "<br>" . mysqli_error($enlace);
            $data = array(
                "resultado" => false,
                "mensaje" => "No se pudo la informacion del sanitario",
                "url" => "../sanitarios.php"
            );
        } else {
            $data = array(
                "resultado" => true,
                "mensaje" => "Informacion removida correctamente",
                "url" => "../sanitarios.php"
            );
        }
    }

    if ($tipo == 'REMOVERSAN') {
        $queryUpdate = "UPDATE servicio_sani set id_san = NULL WHERE id_sersan = '$id_sersan'";
        $resultUpdate = mysqli_query($enlace, $queryUpdate);
        if (!$resultUpdate) {
            echo "Error: " . $queryUpdate . "<br>" . mysqli_error($enlace);
            $data = array(
                "resultado" => false,
                "mensaje" => "No se pudo remover el sanitario",
                "url" => "../sanitarios.php"
            );
        } else {
            //modifico el estatus del sanitarios en la tabla de sanitarios
            $queryUpdateEstatusSan =  "UPDATE sanitarios SET estatus = 'DISPONIBLE' WHERE id_san = '$id';";
            $resultUpdateEstatusSan = mysqli_query($enlace, $queryUpdateEstatusSan);
            if (!$resultUpdateEstatusSan) {
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
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

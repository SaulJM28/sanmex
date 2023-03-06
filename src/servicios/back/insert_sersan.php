<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_san = $_POST['id_san'];
    $id_ser = $_POST['id_ser'];
    include("../../../include/conexion.php");

    $sql1 = "SELECT * FROM servicio_sani WHERE id_san = '$id_san' AND estatus = 'ACTIVO'";
    $result = mysqli_query($enlace, $sql1);

    if ($result->num_rows > 0) { {
            $data = array(
                "resultado" => true,
                "mensaje" => "Este sanitario ya ha sido registrado",
                "url" => "../sanitarios.php"
            );
        }

    } else {
            $sql = " INSERT INTO `servicio_sani` (`id_sersan`, `id_ser`, `id_san`, `estatus`) VALUES (NULL, '$id_ser', '$id_san', 'ACTIVO');";
            $resultado = mysqli_query($enlace, $sql);
            if (!$resultado) {
                echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
                $data = array(
                    "resultado" => false,
                    "mensaje" => "No se pudo hacer el registro",
                    "url" => "../sanitarios.php"
                );
            } else {
                /* in this we need to do the update in the table sanitarios */
                $queryUpdate = "UPDATE sanitarios set estatus = 'EN SERVICIO' WHERE id_san = '$id_san'";
                $resultUpdate = mysqli_query($enlace, $queryUpdate);
                if (!$resultUpdate) {
                    echo "Error: " . $queryUpdate . "<br>" . mysqli_error($enlace);
                    $data = array(
                        "resultado" => false,
                        "mensaje" => "No se pudo hacer el registro",
                        "url" => "../sanitarios.php"
                    );
                } else {
                    $data = array(
                        "resultado" => true,
                        "mensaje" => "Registro insertado correctamente",
                        "url" => "../sanitarios.php"
                    );
                }
            }
    }

    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
?>
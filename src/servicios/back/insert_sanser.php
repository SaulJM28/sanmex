<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {
    $id_ser = $_POST['id_ser'];
    $tipo = $_POST['tipo'];
    $idDire = $_POST['idDire'];
    
  
    include("../../../include/conexion.php");
    $sql = "INSERT INTO `servicio_sani` (`id_sersan`, `id_ser`, `id_san`,  `tipo`, `id_dire`, `estatus`) VALUES (NULL, '$id_ser', NULL, '$tipo', '$idDire', 'ACTIVO');";
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
                    "mensaje" => "Registro insertado correctamente",
                    "url" => "../sanitarios.php"
                );
            }
    //print the result
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

<?php
include "../../../include/config.php";
include "../../../include/utils.php";
$dbConn =  connect($db);
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $id = $_POST['id'];
        $tipo = $_POST['tipoServicio'];
        $sql = $dbConn->prepare("UPDATE tipservicios SET tipo = :tipo WHERE id_tipser = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        if ($sql->execute() !== false && $sql->rowCount() > 0) {
            $data = array(
                "resultado" => true,
                "mensaje" => 'Se ha actualizado correctamente'
            );
        } else {
            $data = array(
                "resultado" => false,
                "mensaje" => 'No se pudo realizar los cambios'
            );
            echo $sql->errorInfo();
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();

    

}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

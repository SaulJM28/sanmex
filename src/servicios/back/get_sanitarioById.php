<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_san = $_POST['num_san'];
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT id_san, num_san, tip_san FROM sanitarios WHERE num_san = '$num_san'  AND  estatus = 'DISPONIBLE';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data = array(
                "resultado" => true,
                "id_san" => $result->id_san,
                "num_san" => $result->num_san,
                "tip_san" => $result->tip_san,
            );
        }
    } else {
        $data = array(
            "resultado" => false,
            "mensaje" => "No se pudo encontrar el sanitario",
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

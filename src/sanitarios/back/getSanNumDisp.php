<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT tip_san, COUNT(tip_san) as total FROM `sanitarios` GROUP BY tip_san;");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "tip_san" => $result->tip_san,
                "total" => $result->total
            );
        }
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
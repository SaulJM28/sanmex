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
    $sql = $dbConn->prepare("SELECT * FROM direcciones WHERE estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_dire" => $result->id_dire,
                "estado" => $result->estado,
                "municipio" => $result->municipio,
                "colonia" => $result->colonia,
                "calle" => $result->calle,
                "num_ext" => $result->num_ext,
                "num_int" => $result->num_int,
                "cp" => $result->cp,
                "coordenadas" => $result->coordenadas,
                "estatus"=> $result->estatus
            );
        }
    }
    $objeto = array('data' => $data);
    $json = json_encode($objeto, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
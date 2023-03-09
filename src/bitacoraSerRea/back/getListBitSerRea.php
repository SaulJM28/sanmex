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
    $sql = $dbConn->prepare("SELECT * FROM bitacora_servicio");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {

            if($result->estatus == 'REALIZADO'){
                $color = '#279b37';
            }else if($result->estatus == 'INCIDENCIA'){
                $color = '#be0027';
            }

            //datos
            $data[] = array(
                "id_bit" => $result->id_bit,
                "servicio" => $result->servicio,
                "cliente" => $result->cliente,
                "sanitario" => $result->sanitario,
                "operador" => $result->operador,
                "fecha" => $result->fecha,
                "evidencia" => $result->evidencia,
                "comentario" => $result->comentario,
                "estatus" => $result->estatus,
                "color" => $color
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



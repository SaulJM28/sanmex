<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_san = $_POST['id_san'];
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT * FROM sanitarios  WHERE num_san = '$id_san' AND estatus = 'EN SERVICIO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        
        foreach ($results as $result) {
            $num_san = $result->num_san;
        }

        $data = array(
            "resultado" => true,
            "mensaje" => 'El sanitario '.$num_san.'  ya esta en servicio'
        );
    }

    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");



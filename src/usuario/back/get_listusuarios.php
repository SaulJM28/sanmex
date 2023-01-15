<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //header para hacer formato JSON
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT id_usu, nom_usu, pwd_usu, tip_usu, U.estatus, U.fec_cre, nom, ap1, ap2 FROM usuarios U JOIN operadores O ON U.id_ope = O.id_ope WHERE  U.estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_usu" => $result->id_usu,
                "nom_usu" => $result->nom_usu,
                "pwd_usu" => $result->pwd_usu,
                "tip_usu" => $result->tip_usu,
                "estatus" => $result->estatus,
                "fec_cre" => $result->fec_cre,
                "nom_ope" => $result->nom ." ". $result->ap1 ." ".$result->ap2 
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
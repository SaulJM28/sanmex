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
    $sql = $dbConn->prepare("SELECT id_rut, nom_rut, fec_reg, nom, ap1, ap2, R.id_ope, R.estatus FROM rutas R LEFT JOIN  operadores O ON R.id_ope = O.id_ope where R.estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_rut" => $result->id_rut,
                "nom_rut" => $result->nom_rut,
                "id_ope" => $result->id_ope,
                "operador" => $result->nom . ' ' . $result->ap1 . ' ' . $result->ap2, 
                "fec_reg" => $result->fec_reg,
                "estatus" => $result->estatus
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
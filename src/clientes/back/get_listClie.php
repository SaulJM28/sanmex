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
    $sql = $dbConn->prepare("SELECT * FROM clientes C INNER JOIN direcciones D ON C.id_dire = D.id_dire WHERE C.estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_clie" => $result->id_clie,
                "nom_clie" => $result->nom_clie,
                "tel_clie" => $result->tel_clie,
                "rfc" => $result->rfc,
                "razon_social" => $result->razon_social,
                "direccion" => $result->estado . ' ' . $result->municipio . ' ' . $result->colonia . ' ' . $result->calle . ' ' . $result->num_ext . ' ' . $result->num_int . ' ' . $result->cp, 
                "fec_cre" => $result->fec_cre,
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
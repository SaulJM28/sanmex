<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = $_POST['key'];
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT * FROM direcciones WHERE colonia LIKE '$key%'  OR calle LIKE '$key%'  AND estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            $data[] = array(
                "resultado" => true,
                "id_dire" => $result->id_dire,
                "estado" => $result->estado,
                "municipio" => $result->municipio,
                "colonia" => $result->colonia,
                "calle" => $result->calle,
                "num_ext" => $result->num_ext,
                "num_int" => $result->num_int,
                "cp" => $result->cp,
                "coordenadas" => $result->coordenadas,
            );
        }
    }else{
        header("HTTP/1.1 200 OK");
        $data[] = array(
            "resultado" => false,
            "mensaje" => "Sin resultados",
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
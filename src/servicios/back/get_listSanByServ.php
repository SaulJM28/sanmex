<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json; charset=utf-8');
      $id_ser = $_POST['id_ser'];
    $sql1 = $dbConn->prepare("SELECT count(SEA.id_ser) as totalRe FROM `servicio_sani` SEA  WHERE SEA.id_ser = '$id_ser' AND (SEA.estatus = 'ACTIVO' OR SEA.estatus = 'FINALIZADO')");
    $sql1->execute();
    $results1 = $sql1->fetchAll(PDO::FETCH_OBJ);

    if ($sql1->rowCount() > 0) {
        foreach ($results1 as $result1) {
           $totalRe =  $result1->totalRe;
        }
    }

    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT SA.num_san, tip_san, SEA.estatus, SE.num_san as sans_rent FROM `servicio_sani` SEA INNER JOIN sanitarios SA ON SEA.id_san = SA.id_san INNER JOIN servicio SE ON SEA.id_ser = SE.id_ser WHERE SEA.id_ser = '$id_ser' AND (SEA.estatus = 'ACTIVO' OR SEA.estatus = 'FINALIZADO')");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);



    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "num_san" => $result->num_san,
                "tip_san" => $result->tip_san,
                "sans_rent" => $result->sans_rent,
                "estatus" => $result->estatus,
                "totalRe" => $totalRe 
            );
        }
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
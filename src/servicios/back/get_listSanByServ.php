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

    $sql1 = $dbConn->prepare("SELECT count(SEA.id_ser) as totalRe FROM `servicio_sani` SEA  WHERE SEA.id_ser = '$id_ser' AND (SEA.estatus = 'ACTIVO' OR SEA.estatus = 'FINALIZADO');");
    $sql1->execute();
    $results1 = $sql1->fetchAll(PDO::FETCH_OBJ);

    if ($sql1->rowCount() > 0) {
        foreach ($results1 as $result1) {
           $totalRe =  $result1->totalRe;
        }
    }

    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT SESA.id_sersan, SESA.id_ser, SESA.id_san, SESA.tipo,  SESA.estatus as estatus_sesa, SE.estatus as estatus_ser, SA.num_san 
    FROM servicio_sani SESA 
    INNER JOIN servicio SE ON SE.id_ser = SESA.id_ser 
    LEFT JOIN sanitarios SA ON SA.id_san = SESA.id_san 
    WHERE SESA.id_ser = '$id_ser'");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            $id_san = $result->id_san;
            $num_san = $result->num_san;
            $color = '#279b37';
            if($result->id_san == null){
                $id_san = 'Sin sanitario asignado';
                $color = '#be0027';
            }
            if($result->num_san == null){
                $num_san = 'Sin sanitario asignado';
                $color = '#be0027';
            }
            if($result->estatus_ser == 'FINALIZADO'){
                $color = '#be0027';
            }
            //datos
            $data[] = array(
                "id_sersan" => $result->id_sersan,
                "id_ser" => $result->id_ser,
                "id_san" => $id_san,
                "num_san" => $num_san,
                "tipo" => $result->tipo,
                "estatus_sesa" => $result->estatus_sesa,
                "estatus_ser" => $result->estatus_ser,
                "color" => $color
            );
        }
    }

    $obj = array(
        "totalRe" => $totalRe,
        "data" => $data
    );

    $json = json_encode($obj, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
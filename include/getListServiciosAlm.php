<?php
include "config.php";
include "utils.php";
$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $limite = $_GET['limite'];

    //header para hacer formato JSON
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    /* Este query cuenta los registro que existen, para hacer el scroll infinito */
    $sql1 = $dbConn->prepare("SELECT COUNT(*) as TotalRegis FROM `servicio`");
    $sql1->execute();
    $results1 = $sql1->fetchAll(PDO::FETCH_OBJ);
    if ($sql1->rowCount() > 0) {
        foreach ($results1 as $result1) {
            //datos
            $totalRegis = $result1->TotalRegis;
        }
    }

    //Mostrar un GET
    /* Este query trae la lista de resultados */
    $sql = $dbConn->prepare("SELECT SE.id_ser, SE.num_ser, SE.tip_ser, SE.num_san, SA.tipo, SE.estatus FROM servicio SE INNER JOIN clientes CLI ON CLI.id_clie = SE.id_clie INNER JOIN servicio_sani SA ON SA.id_ser = SE.id_ser INNER JOIN rutas R ON R.id_rut = SE.id_rut WHERE SE.estatus <> 'INACTIVO' LIMIT 10 OFFSET " . $limite . "");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            if ($result->estatus == 'ACTIVO') {
                $color = '#279b37';
            }
            if ($result->estatus == 'FINALIZADO') {
                $color = '#ffc845';
            }
            $sql2 = $dbConn->prepare("SELECT count(*) as san_regis FROM `servicio_sani` WHERE id_ser = '$result->id_ser'");
            $sql2->execute();
            $results2 = $sql2->fetchAll(PDO::FETCH_OBJ);
            if ($sql2->rowCount() > 0) {
                foreach ($results2 as $result2) {
                    $totalReg = $result2->san_regis;
                }
            }
            if ($result->tip_ser == 'LIMPIEZA SANITARIOS') {
                //datos
                $data[] = array(
                    "resultado" => true,
                    "id_ser" => $result->id_ser,
                    "num_ser" => $result->num_ser,
                    "tip_ser" => $result->tip_ser,
                    "tip_san" => $result->tipo,
                    "san_sol" => $result->num_san,
                    "san_reg" => $totalReg,
                    "estatus" => $result->estatus,
                    "color" => $color,
                );
            }
        }
    } else {
        $data = array(
            "resultado" => false,
            "mensaje" => "No hay servicios"
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

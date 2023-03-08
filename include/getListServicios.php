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
    $sql = $dbConn->prepare("SELECT SE.id_ser, SE.num_san, CLI.nom_clie, CLI.rfc, CLI.razon_social, CLI.nom_con, CLI.num_con, DIRE.estado, DIRE.municipio, DIRE.colonia, DIRE.calle, DIRE.num_ext, DIRE.num_int, DIRE.cp, SE.estatus FROM servicio SE INNER JOIN clientes CLI ON CLI.id_clie = SE.id_clie INNER JOIN direcciones DIRE ON DIRE.id_dire = SE.id_dire WHERE SE.estatus <> 'INACTIVO' LIMIT 10 OFFSET " . $limite ."");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            if($result->estatus == 'ACTIVO'){
                $color = '#279b37';
            }else if ($result->estatus == 'FINALIZADO'){
                $color = '#ffdd00';
            }
            //datos
            $data[] = array(
                "resultado" => true,
                "id_ser" => $result->id_ser,
                "cliente" => array(
                    "nom_clie" => $result->nom_clie,
                    "rfc" => $result->rfc,
                    "razon_social" => $result->razon_social,
                    "nom_con" => $result->nom_con,
                    "num_con" => $result->num_con,
                ),
                "dirreccion" => array(
                    "estado" => $result->estado,
                    "municipio" => $result->municipio,
                    "colonia" => $result->colonia,
                    "calle" => $result->calle,
                    "num_ext" => $result->num_ext,
                    "num_int" => $result->num_int,
                    "cp" => $result->cp,
                ),
                "san_soli" => $result->num_san,
                "totalRe" => $totalRegis,
                "estatus" => $result->estatus,
                "color" => $color
            );
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
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
    $sql = $dbConn->prepare("SELECT id_ser, num_san, cost_unit, cost_tot, tip_pag, dia_de_pag, dias_serv, fec_crea, nom_clie, rfc, razon_social, estado, municipio, colonia, calle, num_ext, num_int, cp, SE.estatus FROM servicio SE INNER JOIN clientes CLI ON CLI.id_clie = SE.id_clie INNER JOIN direcciones DIRE ON DIRE.id_dire = SE.id_dire WHERE SE.estatus <> 'INACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            if($result->estatus == 'ACTIVO'){
                $color = '#279b37';
            }else if($result->estatus == 'FINALIZADO'){
                $color = '#ffdd00';
            }

            //datos
            $data[] = array(
                "id_ser" => $result->id_ser,
                "num_san" => $result->num_san,
                "cost_unit" => $result->cost_unit,
                "cost_tot" => $result->cost_tot,
                "tip_pag" => $result->tip_pag,
                "dia_de_pag" => $result->dia_de_pag,
                "dias_serv" => $result->dias_serv,
                "fec_crea" => $result->fec_crea,
                "estatus" => $result->estatus,
                "direccion" => array(
                    "estado" => $result->estado,
                    "municipio" => $result->municipio,
                    "colonia" => $result->colonia,
                    "calle" => $result->calle,
                    "num_ext" => $result->num_ext,
                    "num_int" => $result->num_int,
                    "cp" => $result->cp, 
                ),
                "cliente" => array(
                    "nom_clie" => $result->nom_clie,
                    "razon_social" => $result->razon_social,
                    "rfc" => $result->rfc
                ),
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



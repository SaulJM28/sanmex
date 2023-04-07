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
    $sql = $dbConn->prepare("SELECT id_ser, num_san, cost_unit, cost_tot, tip_pag, dia_de_pag, dias_serv, fec_crea, nom_clie, rfc, razon_social, nom_con, num_con, estado, municipio, colonia, calle, num_ext, num_int, cp, R.nom_rut, OP.nom, OP.ap1, OP.ap2, SE.estatus FROM servicio SE INNER JOIN clientes CLI ON CLI.id_clie = SE.id_clie INNER JOIN direcciones DIRE ON DIRE.id_dire = SE.id_dire INNER JOIN rutas R ON R.id_rut = SE.id_rut INNER JOIN operadores OP ON OP.id_ope = SE.id_ope WHERE SE.estatus <> 'INACTIVO' LIMIT 10 OFFSET " . $limite ."");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            if($result->estatus == 'ACTIVO'){
                $color = '#279b37';
            }
            if($result->estatus == 'FINALIZADO'){
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
                "totalsan" => $totalReg,
                "totalRe" => $totalRegis,
                "estatus" => $result->estatus,
                "color" => $color,
                "operador" => $result->nom . ' ' . $result->ap1 . ' ' . $result->ap2,
                "ruta" => $result->nom_rut 
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
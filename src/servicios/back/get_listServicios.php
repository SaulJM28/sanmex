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
    $sql = $dbConn->prepare("SELECT S.id_ser, S.num_ser, S.tip_ser, S.num_san, S.fec_ent, S.hor_ent, S.cost_ser, S.tip_pag, S.conct_pag, S.tel_conpag, S.cor_conpag, S.nom_conrec, S.tel_conrec, S.dia_pag, S.estado as estadoS, S.municipio as municipioS, S.colonia as coloniaS, S.calle as calleS, S.num_ext as num_extS, S.num_int as num_intS, S.cp as cpS, S.coordenadas as coordena, S.dias_serv, S.cotzacion, S.sit_fis, S.fec_cre, S.obser, S.estatus as estatusS, D.estado as estadoD, D.municipio as municipioD, D.colonia as coloniaD, D.calle as calleD, D.num_ext as num_extD, D.num_int as num_intD, D.cp as cpD, D.coordenadas as coordenadasD, C.nom_clie, C.tel_clie, C.rfc, C.razon_social FROM `servicio` S INNER JOIN clientes C ON S.id_clie = C.id_clie INNER JOIN direcciones D ON C.id_dire = D.id_dire WHERE S.estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            $fileCot  = "./docs/cotizaciones/".$result->cotzacion;   
            $fileSitFis  = "./docs/situacionFiscal/".$result->sit_fis;
            
            if ($result->estatusS == 'ACTIVO') $color = '#279b37';
            if ($result->estatusS == 'FINALIZADO') $color = '#ffdd00';

            $fileCot = file_exists($fileCot) ? $result->cotzacion : false;
            $fileSitFis = file_exists($fileSitFis) ? $result->sit_fis : false;

            if ($result->estadoS != null) {
                $data[] = array(
                    "id_ser" => $result->id_ser,
                    "num_ser" => $result->num_ser,
                    "tip_ser" => $result->tip_ser,
                    "num_san" => "No aplica",
                    "fec_ent" => $result->fec_ent,
                    "hor_ent" => $result->hor_ent,
                    "cost_ser" => $result->cost_ser,
                    "tip_pag" => $result->tip_pag,
                    "conct_pag" => $result->conct_pag,
                    "tel_conpag" => $result->tel_conpag,
                    "cor_conpag" => $result->cor_conpag,
                    "nom_conrec" => $result->nom_conrec,
                    "tel_conrec" => $result->tel_conrec,
                    "dia_pag" => $result->dia_pag,
                    "rfc_clie" => $result->rfc,
                    "direccion_entrega" => $result->estadoS . ', ' .
                        $result->municipioS . ', ' . $result->coloniaS . ', ' . $result->calleS . ', Num Ext ' .  $result->num_extS . ', Num Int ' . $result->num_intS . ', CP ' . $result->cpS,
                    "cliente" => $result->nom_clie . ', ' . $result->razon_social . ', ' . $result->rfc,
                    "direccion_fiscal" => $result->estadoD . ', ' .
                        $result->municipioD . ', ' . $result->coloniaD . ', ' . $result->calleD . ' Num Ext, ' .  $result->num_extD . ' Num Int, ' . $result->num_intD . ' CP, ' . $result->cpD,
                    "dias_serv" => $result->dias_serv,
                    "cotizacion" => $fileCot,
                    "sit_fis" => $fileSitFis,
                    "obser" => $result->obser,
                    "estatus" => $result->estatusS,
                    "color" => $color
                );
            } else {
                $data[] = array(
                    "id_ser" => $result->id_ser,
                    "num_ser" => $result->num_ser,
                    "tip_ser" => $result->tip_ser,
                    "num_san" => $result->num_san,
                    "fec_ent" => $result->fec_ent,
                    "hor_ent" => $result->hor_ent,
                    "cost_ser" => $result->cost_ser,
                    "tip_pag" => $result->tip_pag,
                    "conct_pag" => $result->conct_pag,
                    "tel_conpag" => $result->tel_conpag,
                    "cor_conpag" => $result->cor_conpag,
                    "nom_conrec" => $result->nom_conrec,
                    "tel_conrec" => $result->tel_conrec,
                    "dia_pag" => $result->dia_pag,
                    "rfc_clie" => $result->rfc,
                    "direccion_entrega" => "No aplica",
                    "cliente" => $result->nom_clie . ', ' . $result->razon_social . ', ' . $result->rfc,
                    "direccion_fiscal" => $result->estadoD . ', ' .
                        $result->municipioD . ', ' . $result->coloniaD . ', ' . $result->calleD . ', Num Ext ' .  $result->num_extD . ', Num Int ' . $result->num_intD . ', CP ' . $result->cpD,
                    "dias_serv" => $result->dias_serv,
                    "cotizacion" => $fileCot,
                    "sit_fis" => $fileSitFis,
                    "obser" => $result->obser,
                    "estatus" => $result->estatusS,
                    "color" => $color
                );
            }
            //datos
        }
    }
    $objeto = array('data' => $data);
    $json = json_encode($objeto, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

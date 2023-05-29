<?php 
if(!$_POST){
    echo "Don't exist method POST";
}else{
    $id_clie = $_POST["id_clie"]; 
    $id_dire = $_POST["id_dire"];
    $tipSer = $_POST["tipSer"]; 
    $numSan = $_POST["numSan"]; 
    $fecEnt = $_POST["fecEnt"]; 
    $horEnt = $_POST["horEnt"]; 
    $cosSer = $_POST["cosSer"]; 
    $tipPag = $_POST["tipPag"]; 
    $conctPag = $_POST["conctPag"]; 
    $telConPag = $_POST["telConPag"]; 
    $corConPag = $_POST["corConPag"]; 
    $NomConRec = $_POST["NomConRec"]; 
    $telConRec = $_POST["telConRec"]; 
    $diaPag = $_POST["diaPag"]; 
    $obser = $_POST["obser"]; 

    echo $id_clie . "<br>"; 
    echo $id_dire . "<br>";
    echo $tipSer . "<br>"; 
    echo $numSan . "<br>"; 
    echo $fecEnt . "<br>"; 
    echo $horEnt . "<br>"; 
    echo $cosSer . "<br>"; 
    echo $tipPag . "<br>"; 
    echo $conctPag . "<br>"; 
    echo $telConPag . "<br>"; 
    echo $corConPag . "<br>"; 
    echo $NomConRec . "<br>"; 
    echo $telConRec . "<br>"; 
    echo $diaPag . "<br>"; 
    echo $obser . "<br>"; 

date_default_timezone_set('america/mexico_city');
$hoy = date('Y-m-d h:i:s');

}
/* include("../../../include/conexion.php");
  $sql = " INSERT INTO `servicio` (
    `id_ser`, 
    `num_ser`, 
    `tip_ser`, 
    `num_san`, 
    `fec_ent`, 
    `hor_ent`, 
    `cost_ser`,
    `tip_pag`,
    `conct_pag`,
    `tel_conpag`,
    `cor_conpag`,
    `nom_conrec`,
    `tel_conrec`,
    `dia_pag`,
    `id_rut`, 
    `dias_serv`,
    `cotzacion`,
    `sit_fis`,
    `coor`,
    `id_clie`,
    `id_dire`,
    `fec_cre`
    ) VALUES (
        NULL, 
        '$num_san', 
        '$cost_unit', 
        '$cost_tot',
        '$tip_pag',
        '$dia_de_pag',
        '$dias', 
        '$hora_aten', 
        '$obser', 
        '$hoy', 
        'ACTIVO',
        '$id_clie',
        '$id_dire',
        '$ruta',
        '$operador');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
        "resultado" => false,
        "mensaje" => "No se pudo hacer el registro",
        "url" => "servicios.php"
    );
  } else {
    $data = array(
        "resultado" => true,
        "mensaje" => "Registro insertado correctamente",
        "url" => "servicios.php"
    );
    } 
    header('Content-Type: application/json; charset=utf-8');  
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}  */

?>
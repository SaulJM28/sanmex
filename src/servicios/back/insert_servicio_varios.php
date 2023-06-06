<?php 
if(!$_POST){
    echo "Don't exist method POST";
}else{
    $id_clie = $_POST["id_clie"]; 
    $tipSer = $_POST["tipSer"]; 
    $numSan = 0; 
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
    $dirEst = $_POST["dirEst"];
    $dirMun =  $_POST["dirMun"];
    $dirCol =  $_POST["dirCol"];
    $dirCalle =  $_POST["dirCalle"];
    $dirNumExt = $_POST["dirNumExt"];
    $dirNumInt = $_POST["dirNumInt"];
    $dirCP =  $_POST["dirCP"];    
    $coord = $_POST["coord"];
    $obser = $_POST["obser"]; 

date_default_timezone_set('america/mexico_city');
$fec_crea = date('Y-m-d h:i:s');
  include("../../../include/conexion.php");
  $sql = "INSERT INTO `servicio` (`id_ser`, `num_ser`, `tip_ser`, `num_san`, 
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
  `estado`, 
  `municipio`, 
  `colonia`, 
  `calle`, 
  `num_ext`, 
  `num_int`, 
  `cp`, 
  `coordenadas`, 
  `id_rut`, 
  `dias_serv`, 
  `cotzacion`, 
  `sit_fis`, 
  `id_clie`, 
  `fec_cre`,
  `obser`, 
  `estatus`) VALUES (
    NULL, 
    NULL, 
    '$tipSer', 
    '$numSan',
    '$fecEnt', 
    '$horEnt', 
    '$cosSer', 
    '$tipPag', 
    '$conctPag', 
    '$telConPag', 
    '$corConPag', 
    '$NomConRec', 
    '$telConRec', 
    '$diaPag', 
    '$dirEst', 
    '$dirMun', 
    '$dirCol', 
    '$dirCalle', 
    '$dirNumExt', 
    '$dirNumInt ', 
    '$dirCP', 
    '$coord', 
    NULL, 
    NULL, 
    NULL, 
    NULL, 
    NULL, 
    NULL, 
    '$obser', 
    'ACTIVO');";

    
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
}

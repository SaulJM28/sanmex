<?php 
if(!$_POST){
    echo "Don't exist method POST";
}else{
    $id_clie = $_POST['id_clie'];
    $id_dire = $_POST['id_dire'];
    $num_san = $_POST['num_san'];
    $cost_unit = $_POST['cost_unit'];
    $cost_tot = $_POST['cost_tot'];
    $tip_pag = $_POST['tip_pag'];
    $dia_de_pag = $_POST['dia_de_pag'];
    $diasServicio = $_POST['diasServicio'];
    $hora_aten = $_POST['hora_aten'];
    $obser = $_POST['obser'];
    $ruta = $_POST['ruta'];
    $operador = $_POST['operador']; 

    $dias = "";
    if(isset($diasServicio['Lunes'])){
        $dias = $dias . "Lunes";
    }
    if(isset($diasServicio['Martes'])){
        $dias =  $dias . "Martes";
    }
    if(isset($diasServicio['Miercoles'])){
        $dias = $dias . "Miercoles";
    }
    if(isset($diasServicio['Jueves'])){
        $dias = $dias . "Jueves";
    }
    if(isset($diasServicio['Viernes'])){
        $dias = $dias . "Viernes";
    }
    if(isset($diasServicio['Sabado'])){
        $dias = $dias . "Sabado";
    }
    if(isset($diasServicio['Domingo'])){
        $dias = $dias . "Domingo";
    }

$underscore = mb_strtolower(preg_replace('/(?<=\w)(\p{Lu})/u', ' $1', $dias));
$plural = $underscore;

date_default_timezone_set('america/mexico_city');
$hoy = date('Y-m-d h:i:s');

include("../../../include/conexion.php");
  $sql = " INSERT INTO `servicio` (
    `id_ser`, 
    `num_san`, 
    `cost_unit`, 
    `cost_tot`, 
    `tip_pag`, 
    `dia_de_pag`, 
    `dias_serv`,
    `hora_aten`,
    `obser`,
    `fec_crea`,
    `estatus`,
    `id_clie`,
    `id_dire`,
    `id_rut`,
    `id_ope`) VALUES (
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
}

?>
<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
    header('Content-Type: application/json; charset=utf-8');
  $nom_ope_add  = $_POST['nom_ope_add'];
  $ap1_ope_add = $_POST['ap1_ope_add'];
  $ap2_ope_add  = $_POST['ap2_ope_add'];
  $tel_ope_add = $_POST['tel_ope_add'];

  date_default_timezone_set('america/mexico_city');
  $hoy = date('Y-m-d h:i:s');

include("../../../include/conexion.php");
  $sql = " INSERT INTO `operadores` (`id_ope`, `nom`, `ap1`, `ap2`, `tel`, `fec_cre`, `estatus`) VALUES (NULL, '$nom_ope_add', '$ap1_ope_add', '$ap2_ope_add', '$tel_ope_add', '$hoy', 'ACTIVO');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
        "resultado" => false,
        "mensaje" => "No se pudo hacer el registro",
        "url" => "../sanitarios.php"
    );
  } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Registro insertado correctamente",
            "url" => "../sanitarios.php"
        );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  } 
}
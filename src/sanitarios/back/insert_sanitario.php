<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
  header('Content-Type: application/json; charset=utf-8');
  $num_san = $_POST['num_san_add'];
  $tip_san = $_POST['tip_san_add'];

  date_default_timezone_set('america/mexico_city');
  $hoy = date('Y-m-d h:i:s');

  include("../../../include/conexion.php");
  $sql = " INSERT INTO `sanitarios` (`id_san`, `num_san`, `tip_san`, `fec_cre`, `estatus`) VALUES (NULL, '$num_san', '$tip_san', '$hoy', 'ACTIVO');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
      "resultado" => false,
      "mensaje" => "No se pudo hacer el registro",
      "url" => "../sanitarios.php"
    );
  } else {
    /* CREAMOS EL CODIGO QR UNICO */

    include('phpqrcode/qrlib.php');
    $content = $num_san;
    $nameQR = 'qr-san-' . $num_san . '-' .$tip_san ;
    QRcode::png($content, 'QRS/' . $nameQR . '.png', QR_ECLEVEL_L, 10, 2);

    $data = array(
      "resultado" => true,
      "mensaje" => "Registro insertado correctamente",
      "url" => "../sanitarios.php"
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  }
}
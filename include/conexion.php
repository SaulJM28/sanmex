<?php
/* conexion memo cliente */
/* $enlace = mysqli_connect("localhost", "u226254042_sa", "s4NM3X_2023", "u226254042_sanmex"); */
$enlace = mysqli_connect("localhost", "root", "", "sanmex");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

/* echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;  */
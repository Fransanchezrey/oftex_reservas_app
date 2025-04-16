<?php
require_once 'funciones.php';

// URL del CSV
$url = "http://devtest.oftex.es";
$usuario = "guest";
$contrasena = "oftex";

$reservas = obtenerCSV($url, $usuario, $contrasena);

echo "<pre>";
print_r($reservas);
echo "</pre>";
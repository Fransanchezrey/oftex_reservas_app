<?php

require_once 'funciones.php';

// URL del CSV
$url = "http://devtest.oftex.es";
$usuario = "guest";
$contrasena = "oftex";

// Obtener reservas
$reservas = obtenerCSV($url, $usuario, $contrasena);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservas</title>

    <script>
        const RESERVAS = <?php echo json_encode($reservas); ?>;
    </script>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Reservas</h1>
        <input type="text" id="busqueda" placeholder="Buscar...">
        <button id="btnLimpiar">Limpiar</button>
        <table id="tablaReservas">
            <thead>
                <tr>
                    <th>Localizador</th>
                    <th>Huésped</th>
                    <th>Fecha Entrada</th>
                    <th>Fecha Salida</th>
                    <th>Hotel</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <button id="descargarJson">Descargar como JSON</button>
    </div>
	
	<script src="script.js"></script>
</body>
</html>

    


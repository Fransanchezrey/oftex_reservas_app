<?php

function obtenerCSV($url, $usuario, $contrasena) {
    // Descargar el CSV 
    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Basic " . base64_encode("$usuario:$contrasena")
        ]
    ]);

    //Obtener contenido URL
    $contenido = file_get_contents($url, false, $context);

    if ($contenido === false) {
        die("Error al obtener el CSV");
    }

    $lineas = explode("\n", trim($contenido));
    $reservas = [];

    $campos = ["Localizador", "Huésped", "FechaEntrada", "FechaSalida", "Hotel", "Precio", "Acciones"];

    foreach ($lineas as $linea) {
        $datos = str_getcsv($linea, ";", '"', "\\");
        if (count($datos) === count($campos)) {
            $reservas[] = array_combine($campos, $datos);
        }
    }

    return $reservas;
}

function filtrarReservas($reservas, $busqueda) {
    if (empty($busqueda)) return $reservas;

    $filtrado = [];
    foreach ($reservas as $reserva) {
        foreach ($reserva as $valor) {
            if (stripos($valor, $busqueda) !== false) {
                $filtrado[] = $reserva;
                break;
            }
        }
    }
    return $filtrado;
}

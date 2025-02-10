<?php
sleep(1);
header("Access-Control-Allow-Origin: *"); // Permite cualquier origen
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once __DIR__ . '/../../../modelos/Estados.php';

$states = [];
$message = "Datos obtenidos correctamente";

if (isset($_GET['id'])) {
    $states = EstadosModelo::buscarEstadoPorID($_GET["id"]);
} else if (isset($_GET['id_country'])) {
    $states = EstadosModelo::buscarEstadoPorIDPais($_GET["id_country"]);
} else if (isset($_GET['country_code'])) {
    $states = EstadosModelo::buscarEstadosPorCountryCode($_GET["country_code"]);
} else if (isset($_GET['nombre'])) {
    $states = EstadosModelo::buscarEstadosPorNombre($_GET["nombre"]);
} else {
    if (isset($_GET['page']) && isset($_GET['limit'])) {
        $states = EstadosModelo::getAllEstados($_GET["page"], $_GET["limit"]);
    } else {
        $message = "Falta pasarle page y limit por GET";
    }
}

$success = count($states) ? true : false;

echo json_encode([
    "success" => $success,
    "data" => $states,
    "message" => $message
]);
BaseDatos::closeConection();

<?php
sleep(1);
header("Access-Control-Allow-Origin: *"); // Permite cualquier origen
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once __DIR__ . '/../../../modelos/Ciudades.php';

$ciudades = [];
$message = "Datos obtenidos correctamente";
if (isset($_GET['id'])) {
    $ciudades = CiudadesModelo::buscarCiudadPorID($_GET["id"]);
} else if (isset($_GET['id_country'])) {
    $ciudades = CiudadesModelo::buscarCiudadesPorIdPais($_GET["id_country"]);
} else if (isset($_GET['id_state'])) {
    $ciudades = CiudadesModelo::buscarCiudadPorIdEstado($_GET["id_state"]);
} else if (isset($_GET['nombre'])) {
    $ciudades = CiudadesModelo::buscarCiudadesPorNombre($_GET["nombre"]);
} else {
    if (isset($_GET['page']) && isset($_GET['limit'])) {
        $ciudades = CiudadesModelo::getAllCiudades($_GET["page"], $_GET["limit"]);
    } else {
        $message = "Falta pasarle page y limit por GET";
    }
}

$success = count($ciudades) ? true : false;

echo json_encode([
    "success" => $success,
    "data" => $ciudades,
    "message" => $message
]);
BaseDatos::closeConection();

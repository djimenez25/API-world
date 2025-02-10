<?php
header("Access-Control-Allow-Origin: *"); // Permite cualquier origen
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once '../../../modelos/Paises.php';

$paises = [];
$message = "Datos obtenidos correctamente";

if (isset($_GET['id'])) {
    $paises = PaisesModelo::buscarPaisPorID($_GET["id"]);
} else if (isset($_GET['iso2'])) {
    $paises = PaisesModelo::buscarPaisPorIso2($_GET["iso2"]);
} else if (isset($_GET['iso3'])) {
    $paises = PaisesModelo::buscarPaisPorIso3($_GET["iso3"]);
} else if (isset($_GET['nombre'])) {
    $paises = PaisesModelo::buscarPaisesPorNombre($_GET["nombre"]);
} else {
    if (isset($_GET['page']) && isset($_GET['limit'])) {
        $paises = PaisesModelo::getAllPaises($_GET["page"], $_GET["limit"]);
    } else {
        $message = "Falta pasarle page y limit por GET";
    }
}

$success = count($paises) ? true : false;

echo json_encode([
    "success" => $success,
    "data" => $paises,
    "message" => $message
]);
BaseDatos::closeConection();

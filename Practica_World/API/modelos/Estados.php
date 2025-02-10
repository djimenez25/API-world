<?php
require_once 'env.php';
require_once 'BaseDatos.php';

class EstadosModelo
{

    /**
     * Obtener todos los estados
     */
    public static function getAllEstados($page, $limit, $type_fetch = PDO::FETCH_OBJ)
    {

        $offset = $page * $limit;

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM states LIMIT :offset , :limite");

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtenemos los paises con un id especifico
     */
    public static function buscarEstadoPorIDPais($country_id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM states
                                                    WHERE country_id = :country_id");

        $stmt->bindParam(':country_id', $country_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener Estados por nombre
     */
    public static function buscarEstadosPorNombre($nombre, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM states
                                                    WHERE name LIKE :nombre");

        $likeBusqueda = '%' . $nombre . '%';
        $stmt->bindParam(':nombre', $likeBusqueda, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener Estados por codigo del pais ISO2
     */
    public static function buscarEstadosPorCountryCode($country_code, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM states
                                                    WHERE country_code = :country_code");

        $stmt->bindParam(':country_code', $country_code, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener paises por ID
     */
    public static function buscarEstadoPorID($id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM states
                                                    WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }
}

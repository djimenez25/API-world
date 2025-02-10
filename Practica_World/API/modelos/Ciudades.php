<?php
require_once 'env.php';
require_once 'BaseDatos.php';

class CiudadesModelo
{

    /**
     * Obtener todos las ciudades
     */
    public static function getAllCiudades($page, $limit, $type_fetch = PDO::FETCH_OBJ)
    {

        $offset = $page * $limit;

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM cities LIMIT :offset , :limite");

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtenemos las ciudades de un estado especifico
     */
    public static function buscarCiudadPorIdEstado($state_id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM cities
                                                    WHERE state_id = :state_id");

        $stmt->bindParam(':state_id', $state_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener Ciudades por nombre
     */
    public static function buscarCiudadesPorNombre($nombre, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM cities
                                                    WHERE name LIKE :nombre");

        $likeBusqueda = '%' . $nombre . '%';
        $stmt->bindParam(':nombre', $likeBusqueda, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener las ciudades de un pais especifico
     */
    public static function buscarCiudadesPorIdPais($id_country, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM cities
                                                    WHERE country_id = :country_id");

        $stmt->bindParam(':country_id', $id_country, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener ciudades por ID
     */
    public static function buscarCiudadPorID($id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM cities
                                                    WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }
}

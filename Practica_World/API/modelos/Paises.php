<?php
require_once 'env.php';
require_once 'BaseDatos.php';

class PaisesModelo
{


    /**
     * Obtener todos los paises
     */
    public static function getAllPaises($page, $limit, $type_fetch = PDO::FETCH_OBJ)
    {

        $offset = $page * $limit;

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM countries LIMIT :offset , :limite");

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limite', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener paises por nombre
     */
    public static function buscarPaisesPorNombre($nombre, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM countries
                                                    WHERE name LIKE :nombre");

        $likeBusqueda = '%' . $nombre . '%';
        $stmt->bindParam(':nombre', $likeBusqueda, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener paises por ISO Alpha-2
     */
    public static function buscarPaisPorIso2($iso2, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM countries
                                                    WHERE iso2 = :iso2");

        $stmt->bindParam(':iso2', $iso2, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener paises por ISO Alpha-3
     */
    public static function buscarPaisPorIso3($iso3, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM countries
                                                    WHERE iso3 = :iso3");

        $stmt->bindParam(':iso3', $iso3, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtener paises por ID
     */
    public static function buscarPaisPorID($id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM countries
                                                    WHERE id = :id");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }
}

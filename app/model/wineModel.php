<?php
require_once "./app/Model/model.php";
class WineModel extends Model
{


    public function getWineList($arrayParams)
    {
        $queryParams = $this->getQueryParams($arrayParams);

        $query = $this->getDB()->prepare("  SELECT id, vinos.nombre, bodegas.nombre as bodega, cepa, anio, precio, stock, recomendado
                                            FROM `vinos`
                                            INNER JOIN `bodegas`
                                            ON vinos.bodega = bodegas.id_bodega "
                                            .$queryParams["filter"]
                                            .$queryParams["order"] 
                                            .$queryParams["pagination"]); 
        $query->execute();

        $wines = $query->fetchAll(PDO::FETCH_OBJ);

        return $wines;
    }


    public function getWine($wine)
    {
        $query = $this->getDB()->prepare("  SELECT id, vinos.nombre as nombre, bodegas.nombre as bodega, pais, provincia as region, maridaje, cepa, anio, stock, precio, caracteristica, recomendado 
                                            FROM `vinos`
                                            INNER JOIN `bodegas`
                                            ON vinos.bodega = bodegas.id_bodega 
                                            WHERE id = ? ");
        $query->execute([$wine]);

        $wine = $query->fetch(PDO::FETCH_OBJ);

        return $wine;
    }

    public function upDateWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado, $id)
    {

        $query = $this->getDB()->prepare("UPDATE `vinos` SET nombre = ?, bodega = ?, anio = ?, maridaje = ?, cepa = ?,
                                                        stock = ?, precio = ?, caracteristica = ?, recomendado = ? WHERE id = ?");

        $query->execute([$nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado, $id]);

        return $query;
    }

    public function deleteWine($id)
    {
        
        $query = $this->getDB()->prepare("DELETE FROM `vinos` WHERE id = ?");
        $query->execute([$id]);

        return $query;
    }

    public function addWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado)
    {
        $query = $this->getDB()->prepare("INSERT INTO `vinos`(nombre, bodega, anio, maridaje, cepa, stock, precio, caracteristica, recomendado) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute([$nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado]);

        return $this->getDB()->lastInsertId();
    }

}

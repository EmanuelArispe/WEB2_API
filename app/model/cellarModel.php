<?php

class CellarModel extends Model{

    
    public function getAllCellar($arrayParams){

        $queryParams = $this->getQueryParams($arrayParams, MYSQL_TABLECAT);

        $query = $this->getDB()->prepare("SELECT * FROM `bodegas` "
                                                                    .$queryParams["filter"]
                                                                    .$queryParams["order"] 
                                                                    .$queryParams["pagination"]);
        $query->execute();

        $wineCellar = $query->fetchAll(PDO::FETCH_OBJ);

        return $wineCellar;
    }


    public function getCellar($cellar){
        $query = $this->getDB()->prepare("SELECT * FROM `bodegas` WHERE id_bodega = ?");
        $query->execute([$cellar]);

        $wineCellar = $query->fetch(PDO::FETCH_OBJ);

        return $wineCellar;
    }

    public function upDateCellar($bodega, $pais, $provincia, $descripcion, $idCellar){
        $query = $this->getDB()->prepare("UPDATE `bodegas` SET bodega = ?, pais = ?, provincia = ?, descripcion = ? WHERE id_bodega = ?");
        $query->execute([$bodega, $pais, $provincia, $descripcion, $idCellar]);

        return $query;
    }

    public function deleteCellar($cellar){
        $query = $this->getDB()->prepare("DELETE FROM `bodegas` WHERE id_bodega = ?");
        $query->execute([$cellar]);

        return $query;
    }


    public function addCellar($bodega, $pais, $provincia, $descripcion){
        $query = $this->getDB()->prepare("INSERT INTO `bodegas`(bodega, pais, provincia, descripcion) VALUES (?, ?, ?, ?)");
        $query->execute([$bodega, $pais, $provincia, $descripcion]);

        return $this->getDB()->lastInsertId();
    }

    
}

<?php

class CellarModel extends Model{

    
    public function getAllCellar($addOrder, $addpagination,$addFilter){
        $query = $this->getDB()->prepare("SELECT * FROM `bodegas` $addFilter $addOrder $addpagination");
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

    public function upDateCellar($nombre, $pais, $provincia, $descripcion, $idCellar){
        $query = $this->getDB()->prepare("UPDATE `bodegas` SET nombre = ?, pais = ?, provincia = ?, descripcion = ? WHERE id_bodega = ?");
        $query->execute([$nombre, $pais, $provincia, $descripcion, $idCellar]);

        return $query;
    }

    public function deleteCellar($cellar){
        $query = $this->getDB()->prepare("DELETE FROM `bodegas` WHERE id_bodega = ?");
        $query->execute([$cellar]);

        return $query;
    }


    public function addCellar($nombre, $pais, $provincia, $descripcion){
        $query = $this->getDB()->prepare("INSERT INTO `bodegas`(nombre, pais, provincia, descripcion) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $pais, $provincia, $descripcion]);

        return $this->getDB()->lastInsertId();
    }


}

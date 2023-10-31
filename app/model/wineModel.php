<?php
require_once "./app/Model/model.php";
class WineModel extends Model{


    public function getWineList(){
        $query = $this->getDB()->prepare("SELECT * FROM `vinos`");
        $query->execute();
        
        $wines = $query->fetchAll(PDO::FETCH_OBJ);

        return $wines;
    }


    public function getWine($wine){
        $query = $this->getDB()->prepare("SELECT * FROM `vinos` WHERE id = ? ");
        $query->execute([$wine]);
        
        $wine = $query->fetch(PDO::FETCH_OBJ);
        
        return $wine;
    }

    public function upDateWine($nombre,$bodega,$anio,$maridaje,$cepa,$stock,$precio,$caracteristica,$recomendado,$id){

        $query = $this->getDB()->prepare("UPDATE `vinos` SET nombre = ?, bodega = ?, anio = ?, maridaje = ?, cepa = ?,
                                                        stock = ?, precio = ?, caracteristica = ?, recomendado = ? WHERE id = ?");

        $query->execute([$nombre,$bodega,$anio,$maridaje,$cepa,$stock,$precio,$caracteristica,$recomendado,$id]);
        
        return $this->getDB()->lastInsertId();
    }

    public function deleteWine($id){
        $query = $this->getDB()->prepare("DELETE FROM `vinos` WHERE id = ?");
        $query->execute([$id]);
        
        return $query;
    }

    public function addWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado){
        $query = $this->getDB()->prepare("INSERT INTO `vinos`(nombre, bodega, anio, maridaje, cepa, stock, precio, caracteristica, recomendado) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute([$nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado]);

        return $this->getDB()->lastInsertId();
    }
}
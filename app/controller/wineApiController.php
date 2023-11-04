<?php
require_once('./app/model/wineModel.php');
require_once('./app/controller/apiController.php');
require_once('./app/helpers/verifyHelper.php');
require_once('./app/model/cellarModel.php');
class WineApiController extends ApiController
{
    private $model;
    private $modelCellar;

    function __construct(){
        parent::__construct();
        $this->model = new WineModel();
        $this->modelCellar = new CellarModel();
    }

    function getModel(){
        return $this->model;
    }

    function getModelCellar(){
        return $this->modelCellar;
    }

    function getAll(){
        $this->getView()->response($this->getModel()->getWineList(), 200);
    }

    function getWine($params = []){

        $wine = $this->getModel()->getWine($params[':ID']);
        if (!empty($wine)) {
            $this->getView()->response($wine, 200);
        } else {
            $this->getView()->response(['msg' => 'El vino con con el ID = ' . $params[':ID'] . ' No existe'], 404);
        }
    }

    function deleteWine($params = []){
        $id = $params[':ID'];
        $wine = $this->getModel()->getWine($id);

        if (!empty($wine)) {
            $this->getModel()->deleteWine($id);
            $this->getView()->response(['msg' => 'Se elimino con exito el ID = ' . $id], 200);
        } else {
            $this->getView()->response(['msg' => 'No se puedo eliminar el ID = ' . $id . ' No existe'], 404);
        }
    }


    function addwine(){

        $body = $this->getData();

        if(!VerifyHelpers::verifyData($body)){
            $this->getView()->response(['msg' => 'No hay elementos para agregar'], 404);
            return;
        }

        $nombre = $body->nombre;
        $bodega = $body->bodega;
        $maridaje = $body->maridaje;
        $cepa = $body->cepa;
        $anio = $body->anio;
        $stock = $body->stock;
        $precio = $body->precio;
        $caracteristica = $body->caracteristica;
        $recomendado = $body->recomendado;

        $cellar = $this->getModelCellar()->getCellar($bodega);

        if(empty($cellar)){
            $this->getView()->response(['msg' => 'La bodega con con el ID = '.$bodega.' No existe'],404);
            return;
        }

        $id = $this->getModel()->addWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado);
        if(!empty($id)){
            $this->getView()->response(['msg' => 'El vino fue creado con exito con el ID = ' . $id], 201);
        }else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }

    }
    


    function upDateWine($params = []) {
        $id = $params[':ID'] ?? null;
    
        if (empty($id)) {
            $this->getView()->response(['msg' => 'ID  vacio'], 404);
            return;
        }
    
        $wine = $this->getModel()->getWine($id);
    
        if (empty($wine)) {
            $this->getView()->response(['msg' => 'No se puedo actualizar el ID = ' . $id . ' No existe'], 404);
            return;
        }
    
        $body = $this->getData();
        $nombre = $body->nombre ?? $wine->nombre;
        $bodega = $body->bodega ?? $wine->bodega;
        $maridaje = $body->maridaje ?? $wine->maridaje;
        $cepa = $body->cepa ?? $wine->cepa;
        $anio = $body->anio ?? $wine->anio;
        $stock = $body->stock ?? $wine->stock;
        $precio = $body->precio ?? $wine->precio;
        $caracteristica = $body->caracteristica ?? $wine->caracteristica;
        $recomendado = $body->recomendado ?? $wine->recomendado;
        

        $result = $this->getModel()->upDateWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado, $id);
    
        if ($result) {
            $this->getView()->response(['msg' => 'El vino con ID = ' . $id . ' fue actualizada con exito'], 200);
        } else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }
    }
}

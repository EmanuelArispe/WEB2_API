<?php
require_once('./app/model/wineModel.php');
require_once('./app/controller/apiController.php');
class WineApiController extends ApiController
{
    private $model;

    function __construct()
    {
        parent::__construct();
        $this->model = new WineModel();
    }

    function getAll()
    {
        $this->getView()->response($this->model->getWineList(), 200);
    }

    function getWine($params = [])
    {

        $wine = $this->model->getWine($params[':ID']);
        if (!empty($wine)) {
            $this->getView()->response($wine, 200);
        } else {
            $this->getView()->response(['msg' => 'El vino con con el ID = ' . $params[':ID'] . ' No existe'], 404);
        }
    }

    function deleteWine($params = [])
    {
        $id = $params[':ID'];
        $wine = $this->model->getWine($id);

        if (!empty($wine)) {
            //$this->model->deleteWine($id);
            $this->getView()->response(['msg' => 'Se elimino con exito el ID = ' . $id], 200);
        } else {
            $this->getView()->response(['msg' => 'No se puedo eliminar el ID = ' . $id . ' No existe'], 404);
        }
    }

    //FANTA HACER CONTROL DE DATOS DE LA DOC A AGREGAR funcion AddWine

    function addwine($params = []){
        $body = $this->getData();

        if (!empty($body)) {

            $nombre = $body->nombre;
            $bodega = $body->bodega;
            $maridaje = $body->maridaje;
            $cepa = $body->cepa;
            $anio = $body->anio;
            $stock = $body->stock;
            $precio = $body->precio;
            $caracteristica = $body->caracteristica;
            $recomendado = $body->recomendado;

            $id = $this->model->addWine($nombre, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado);
            $this->getView()->response(['msg' => 'El vino fue creado con exito con el ID = ' . $id], 201);

        } else {
            $this->getView()->response(['msg' => 'No hay elementos para agregar'], 404);
        }
    }
}

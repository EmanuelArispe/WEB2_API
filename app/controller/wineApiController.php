<?php
require_once('./app/model/wineModel.php');
require_once('./app/controller/apiController.php');
require_once('./app/helpers/verifyHelper.php');
require_once('./app/model/cellarModel.php');
require_once('./app/helpers/authHelper.php');

class WineApiController extends ApiController{
    private $model;
    private $modelCellar;
    private $authHelper;

    function __construct(){
        parent::__construct();
        $this->model = new WineModel();
        $this->modelCellar = new CellarModel();
        $this->authHelper = new AuthHelper();
    }

    function getModel(){
        return $this->model;
    }

    function getModelCellar(){
        return $this->modelCellar;
    }

    public function getAuthHelper(){
        return $this->authHelper;
    }

    function getAll(){    

        $order = VerifyHelpers::queryOrder($_GET);
        $sort= VerifyHelpers::querySort($_GET,$this->getModel()->getColumns(MYSQL_TABLEPROD));

        $elem = VerifyHelpers::queryElem($_GET, $this->getModel()->getContElem(MYSQL_TABLEPROD));
        $limit = VerifyHelpers::queryLimit($_GET, $this->getModel()->getContElem(MYSQL_TABLEPROD));


        $filter = VerifyHelpers::queryFilter($_GET, $this->getModel()->getColumns(MYSQL_TABLEPROD));
        $value = VerifyHelpers::queryValue($_GET);
        $operator = VerifyHelpers::queryOperation($_GET);


        $arrayParams = array(   "order"     => ($order)      ? $_GET["order"]     : null,
                                "sort"      => ($sort)       ? $_GET["sort"]      : null,
                                "elem"      => ($elem)       ? $_GET["elem"]      : null,
                                "limit"     => ($limit)      ? $_GET["limit"]     : null,
                                "filter"    => ($filter)     ? $_GET["filter"]    : null,
                                "value"     => ($value)      ? $_GET["value"]     : null,
                                "operator"  => ($operator)   ? $_GET["operator"]  : null);


        $items = $this->getModel()->getWineList($arrayParams);

        if(!empty($items)){
            $this->getView()->response($items,200);
        }else{
            $this->getView()->response(['msg' => 'No hay elementos para mostrar'],204);
        }
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
        $wine = $this->getModel()->getOnlyWine($id);

        if (!empty($wine)) {
            $this->getModel()->deleteWine($id);
            $this->getView()->response(['msg' => 'Se elimino con exito el ID = ' . $id], 200);
        } else {
            $this->getView()->response(['msg' => 'No se puedo eliminar el ID = ' . $id . ' No existe'], 404);
        }
    }


    function addwine(){
        $user = $this->getAuthHelper()->currentUser();

        if(!$user){
            $this->getView()->response(['msg' => 'Usuario no autorizado'],401);
            return;
        }

        $body = $this->getData();

        $arrayValue = array ('vino'           => $body->vino,
                             'bodega'         => $body->bodega,
                             'maridaje'       => $body->maridaje,
                             'cepa'           => $body->cepa,
                             'anio'           => $body->anio,
                             'stock'          => $body->stock,
                             'precio'         => $body->precio,
                             'caracteristica' => $body->caracteristica,
                             'recomendado'    => ($body->recomendado) ? 1:0);

        if(!VerifyHelpers::verifyData($arrayValue)){
            $this->getView()->response(['msg' => 'Por favor completar todos los campos'], 404);
            return;
        }

        $cellar = $this->getModelCellar()->getCellar($arrayValue['bodega']);

        if(empty($cellar)){
            $this->getView()->response(['msg' => 'La bodega con con el ID = '.$arrayValue['bodega'].' No existe'],404);
            return;
        }

        $id = $this->getModel()->addWine($arrayValue);
        if(!empty($id)){
            $this->getView()->response(['msg' => 'El vino fue creado con exito con el ID = ' . $id], 201);
        }else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }

    }
    


    function upDateWine($params = []) {

        $user = $this->getAuthHelper()->currentUser();

        if(!$user){
            $this->getView()->response(['msg' => 'Usuario no autorizado'],401);
            return;
        }
        
        $id = $params[':ID'] ?? null;
    
        if (empty($id)) {
            $this->getView()->response(['msg' => 'ID  vacio'], 404);
            return;
        }
    
        $wine = $this->getModel()->getOnlyWine($id);
    
        if (empty($wine)) {
            $this->getView()->response(['msg' => 'No se puedo actualizar el ID = ' . $id . ' No existe'], 404);
            return;
        }
    
        $body = $this->getData();
        $vino = $body->vino ?? $wine->vino;
        $bodega = $body->bodega ?? $wine->bodega;
        $maridaje = $body->maridaje ?? $wine->maridaje;
        $cepa = $body->cepa ?? $wine->cepa;
        $anio = $body->anio ?? $wine->anio;
        $stock = $body->stock ?? $wine->stock;
        $precio = $body->precio ?? $wine->precio;
        $caracteristica = $body->caracteristica ?? $wine->caracteristica;
        $recomendado = $body->recomendado ?? $wine->recomendado;
        

        $result = $this->getModel()->upDateWine($vino, $bodega, $anio, $maridaje, $cepa, $stock, $precio, $caracteristica, $recomendado, $id);
    
        if ($result) {
            $this->getView()->response(['msg' => 'El vino con ID = ' . $id . ' fue actualizado con exito'], 200);
        } else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }
    }



}

<?php
    require_once ('./app/model/cellarModel.php');
    require_once ('./app/controller/apiController.php');
    require_once ('./app/helpers/verifyHelper.php');
    require_once ('./app/helpers/authHelper.php');
    class CellarApiController extends ApiController{
        private $model;
        private $authHelper;

        function __construct(){
            parent::__construct();
            $this->model = new CellarModel();
            $this->authHelper = new AuthHelper();
        }

        function getModel(){
            return $this->model;
        }

        
    public function getAuthHelper(){
        return $this->authHelper;
    }

        function getAll(){

            $order = VerifyHelpers::queryOrder($_GET);
            $sort= VerifyHelpers::querySort($_GET,$this->getModel()->getColumns(MYSQL_TABLECAT));

            $elem = VerifyHelpers::queryElem($_GET, $this->getModel()->getContElem(MYSQL_TABLECAT));
            $limit = VerifyHelpers::queryLimit($_GET, $this->getModel()->getContElem(MYSQL_TABLECAT));

            $filter = VerifyHelpers::queryFilter($_GET, $this->getModel()->getColumns(MYSQL_TABLECAT));
            $value = VerifyHelpers::queryValue($_GET);
            $operator = VerifyHelpers::queryOperation($_GET);

            $arrayParams = array(   "order"     => ($order)     ? $_GET["order"]     : null,
                                    "sort"      => ($sort)      ? $_GET["sort"]      : null,
                                    "elem"      => ($elem)      ? $_GET["elem"]      : null,
                                    "limit"     => ($limit)     ? $_GET["limit"]     : null,
                                    "filter"    => ($filter)    ? $_GET["filter"]    : null,
                                    "value"     => ($value)     ? $_GET["value"]     : null,
                                    "operator"  => ($operator)  ? $_GET["operator"]  : null);
            
            $items = $this->getModel()->getAllCellar($arrayParams);

            if(!empty($items)){
                $this->getView()->response($items,200);
            }else{
                $this->getView()->response(['msg' => 'No hay elementos para mostrar'],204);
            }

            
        }

        function getCellar($params = []){
            
            $cellar = $this->getModel()->getCellar($params[':ID']);
            if(!empty($cellar)){
                $this->getView()->response($cellar,200);
            }else{
                $this->getView()->response(['msg' => 'La bodega con con el ID = '.$params[':ID'].' No existe'],404);
            }
        }


        public function deleteCellar($params = []){
            if(!empty($params) && is_numeric($params[':ID'])){
                $id=$params[':ID'];
                try{
                    $deleteCat =$this->getModel()->deleteCellar($id);
                    if($deleteCat){
                        $this->getView()->response(['msg' => 'Se elimino con exito el ID = '.$id], 200);
                    }else{
                        $this->getView()->response(['msg' => 'No se puedo eliminar el ID = '.$id.' No existe'], 404);
                    }
                }catch(PDOException $exc){
                    $this->getView()->response(['msg' => 'No se puedo elimiar la categoria. Verificar productos asociados '.$exc],400);
                }
            }else{
                $this->getView()->response(['msg' => 'Ingrese los campos correctamente'], 400);
            }
        }

        function addCellar(){
            $user = $this->getAuthHelper()->currentUser();

            if(!$user){
                $this->getView()->response(['msg' => 'Usuario no autorizado'],401);
                return;
            }
            $body = $this->getData();
            
            if(!VerifyHelpers::verifyData($body)){
                $this->getView()->response(['msg' => 'No hay elementos para agregar'], 400);
                return;
            }

            $bodega = $body->bodega;
            $pais = $body-> pais;
            $provincia = $body->provincia;
            $descripcion = $body->descripcion;
    
            $id = $this->getModel()->addCellar($bodega, $pais, $provincia, $descripcion);
            if(!empty($id)){
                $this->getView()->response(['msg' => 'La bodega fue creada con exito con el ID = ' . $id], 201);
            }else {
                $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
            }
        }



    function upDateCellar($params = []) {
        $user = $this->getAuthHelper()->currentUser();

        if(!$user){
            $this->getView()->response(['msg' => 'Usuario no autorizado'],401);
            return;
        }
        $id = $params[':ID'] ?? null;
    
        if (empty($id)) {
            $this->getView()->response(['msg' => 'Ingrese los campos correctamente'], 404);
            return;
        }
    
        $cellar = $this->getModel()->getCellar($id);
    
        if (empty($cellar)) {
            $this->getView()->response(['msg' => 'No se puedo actualizar el ID = ' . $id . ' No existe'], 404);
            return;
        }
    
        $body = $this->getData();
        $bodega = $body->bodega ?? $cellar->bodega;
        $pais = $body->pais ?? $cellar->pais;
        $provincia = $body->provincia ?? $cellar->provincia;
        $descripcion = $body->descripcion ?? $cellar->descripcion;
        

        $result = $this->getModel()->upDateCellar($bodega, $pais, $provincia, $descripcion, $id);
    
        if ($result) {
            $this->getView()->response(['msg' => 'La bodega ID = ' . $id . ' fue actualizada con exito'], 200);
        } else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }
    }

} 


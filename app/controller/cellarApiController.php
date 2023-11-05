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
            $addOrder = VerifyHelpers::queryOrder($_GET,$this->getModel()->getColumns(MYSQL_TABLECAT));
            $addpagination = VerifyHelpers::queryPagination($_GET, $this->getModel()->getContElem(MYSQL_TABLECAT));
            $addFilter = VerifyHelpers::queryFilter($_GET, $this->getModel()->getColumns(MYSQL_TABLECAT));
            $this->getView()->response($this->getModel()->getAllCellar($addOrder,$addpagination,$addFilter),200);
        }

        function getCellar($params = []){
            
            $cellar = $this->getModel()->getCellar($params[':ID']);
            if(!empty($cellar)){
                $this->getView()->response($cellar,200);
            }else{
                $this->getView()->response(['msg' => 'La bodega con con el ID = '.$params[':ID'].' No existe'],404);
            }
        }

        function deleteCellar($params = []){
            $id = $params[':ID'];
            $cellar = $this->getModel()->getCellar($id);


            if(!empty($cellar)){
                $this->getModel()->deleteCellar($id);
                $this->getView()->response(['msg' => 'Se elimino con exito el ID = '.$id], 200);
            }else{
                $this->getView()->response(['msg' => 'No se puedo eliminar el ID = '.$id.' No existe'], 404);
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
                $this->getView()->response(['msg' => 'No hay elementos para agregar'], 404);
                return;
            }

            $nombre = $body->nombre;
            $pais = $body-> pais;
            $provincia = $body->provincia;
            $descripcion = $body->descripcion;
    
            $id = $this->getModel()->addCellar($nombre, $pais, $provincia, $descripcion);
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
            $this->getView()->response(['msg' => 'ID  vacio'], 404);
            return;
        }
    
        $cellar = $this->getModel()->getCellar($id);
    
        if (empty($cellar)) {
            $this->getView()->response(['msg' => 'No se puedo actualizar el ID = ' . $id . ' No existe'], 404);
            return;
        }
    
        $body = $this->getData();
        $nombre = $body->nombre ?? $cellar->nombre;
        $pais = $body->pais ?? $cellar->pais;
        $provincia = $body->provincia ?? $cellar->provincia;
        $descripcion = $body->descripcion ?? $cellar->descripcion;
        

        $result = $this->getModel()->upDateCellar($nombre, $pais, $provincia, $descripcion, $id);
    
        if ($result) {
            $this->getView()->response(['msg' => 'La bodega ID = ' . $id . ' fue actualizada con exito'], 200);
        } else {
            $this->getView()->response(['msg' => 'Falla en la actualizacion del ID: ' . $id], 500);
        }
    }

} 


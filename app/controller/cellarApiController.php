<?php
    require_once ('./app/model/cellarModel.php');
    require_once ('./app/controller/apiController.php');
    class CellarApiController extends ApiController{
        private $model;

        function __construct(){
            parent::__construct();
            $this->model = new CellarModel();
        }

        function getAll(){
            $this->getView()->response($this->model->getAllCellar(),200);
        }

        function getCellar($params = []){
            
            $cellar = $this->model->getCellar($params[':ID']);
            if(!empty($cellar)){
                $this->getView()->response($cellar,200);
            }else{
                $this->getView()->response(['msg' => 'La bodega con con el ID = '.$params[':ID'].' No existe'],404);
            }
        }

        function deleteCellar($params = []){
            $id = $params[':ID'];
            $cellar = $this->model->getCellar($id);

            if(!empty($cellar)){
                //$this->model->deleteCellar($id);
                $this->getView()->response(['msg' => 'Se elimino con exito el ID = '.$id], 200);
            }else{
                $this->getView()->response(['msg' => 'No se puedo eliminar el ID = '.$id.' No existe'], 404);
            }
        }

        //FANTA HACER CONTROL DE DATOS DE LA DOC A AGREGAR funcion AddWine

        function addCellar($params = []){
            $body = $this->getData();
    
            if (!empty($body)) {
    
                $nombre = $body->nombre;
                $pais = $body-> pais;
                $provincia = $body->provincia;
                $descripcion = $body->descripcion;
    
                $id = $this->model->addCellar($nombre, $pais, $provincia, $descripcion);
                $this->getView()->response(['msg' => 'La bodega fue creado con exito con el ID = ' . $id], 201);
    
            } else {
                $this->getView()->response(['msg' => 'No hay elementos para agregar'], 404);
            }
        }
    }

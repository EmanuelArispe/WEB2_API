
<?php
class VerifyHelpers{

    public static function verifyData($data)
    {
        foreach ($data as $elem) {
            if (!(isset($elem)) || (empty($elem))) {
                return false;
            }
        }
        return true;
    }

    public static function queryOrder($data,$colums){

        if((!isset($data['sort'])|| empty($data['sort'])) && 
            (!isset($data['order'])|| empty($data['order']))){
                return ' ';
            }

        $sort = $data['sort'];
        $order = $data['order'];


        if(in_array($sort,$colums) &&
            (($order == 'DESC') || ($order = 'ASC'))){
                return " ORDER BY ".$sort. " ".$order;

        }else{
            return " ";
        }

    }

    public static function queryPagination($data,$contElement){
        if((!isset($data['page'])|| empty($data['page'])) && 
            (!isset($data['limit'])|| empty($data['limit']))){
                return "";
            }

            $page = $data['page'];
            $limit = $data['limit'];

            if(($page <= $contElement) && ($limit <=$contElement)){
                return " LIMIT ".$page.", ".$limit;
            }else{
                return "";
            }

    }

    public static function queryFilter($data,$colums){
        if((!isset($data['filter'])|| empty($data['filter'])) && 
        (!isset($data['value'])|| empty($data['value']))){
            return "";
        }

        $filter = $data['filter'];
        $value = $data['value'];
        
        //FALTA VERIFICAR QUE EL VALOR DE VALUE SEA CORRECTO evitar inyeccion

        if(in_array($filter,$colums)){
                return " WHERE ".$filter ." = '" .$value ."' ";
        }else{
            return "";
        }
    }

}
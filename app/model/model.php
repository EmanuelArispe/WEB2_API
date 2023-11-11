<?php
require_once "./config.php";
class Model
{
  private $db;

  public function __construct(){
    $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
  }

  public function getDB(){
    return $this->db;
  }

  public function getColumns($table){
    $query = $this->getDB()->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ?");
    $query->execute([$table]);

    $colums = $query->fetchAll(PDO::FETCH_COLUMN);

    return $colums;
  }

  public function getContElem($table){
    $query = $this->getDB()->prepare("SELECT count(*) FROM $table");
    $query->execute();

    $contElement = $query->fetch(PDO::FETCH_NUM);

    return $contElement;
  }

  public function getQueryParams($arrayParams){
    $querryParams = array(
      "filter"     => "",
      "order"      => "",
      "pagination" => ""
    );

    if ($arrayParams["sort"] != null) {
      if ($arrayParams["order"] != null) {
        $querryParams["order"] = " ORDER BY " . $arrayParams["sort"] . " " . $arrayParams["order"];
      } else {
        $querryParams["order"] = " ORDER BY " . $arrayParams["sort"] . " ASC ";
      }
    }

    if (($arrayParams["page"] != null) && ($arrayParams["limit"] != null)) {
      $querryParams["pagination"] = " LIMIT " . $arrayParams["page"] . ", " . $arrayParams["limit"];
    }

    if (($arrayParams["filter"] != null) && ($arrayParams["value"] != null)) {
        switch($arrayParams["operator"]){
          case '<':
          case '>':
          case '=':
          case '<=':
          case '>=':
          case '<>': 
            $querryParams["filter"] = " WHERE " .$arrayParams["filter"] ."  " .$arrayParams["operator"] ." " .$arrayParams["value"];
          break;
          case 'LIKE': $querryParams["filter"] = " WHERE " . $arrayParams["filter"] . "  " . $arrayParams["operator"] . " '" .$arrayParams["value"]. "'";
          break;
          default : $querryParams["filter"] = " WHERE " . $arrayParams["filter"] . " = '" . $arrayParams["value"] ."' ";
          break;
        }
    }
    return $querryParams;
  }
}

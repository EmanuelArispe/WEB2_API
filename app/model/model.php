<?php
require_once "./config.php";
class Model{
    private $db;

    public function __construct(){             
      $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getDB()
    {
        return $this->db;
    }
}
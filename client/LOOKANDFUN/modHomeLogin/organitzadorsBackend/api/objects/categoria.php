<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.php");
class Categoria{

    private $conn; // database connection
    private $table_name = "categories"; //taula

    // object properties
    public $id_cat; //
    public $nom_cat;

    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    // read items
    function readAll(){

        // select all query
        $query = "SELECT
                id_cat, nom_cat
            FROM
                " . $this->table_name . "
            ORDER BY
                id_cat ASC"; //ficar es mode TOMEU ////////(passar order by as default par)
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}

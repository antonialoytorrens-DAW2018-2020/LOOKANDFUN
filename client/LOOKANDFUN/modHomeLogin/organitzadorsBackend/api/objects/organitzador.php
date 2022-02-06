<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.php");
class Organitzador{

    private $conn; // database connection
    private $table_name = "organitzadors"; //taula

    // object properties
    public $id_org; //
    public $nom_org;

    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    // read products
    function readAll(){

        // select all query
        $query = "SELECT
                id_org, nom_org
            FROM
                " . $this->table_name . "
            ORDER BY
                id_org ASC"; //ficar order by as par with a default in function
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
}

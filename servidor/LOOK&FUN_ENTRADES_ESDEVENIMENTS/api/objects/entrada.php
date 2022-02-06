<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.php");
require_once ("$base/config/db.const.php");
class Entrada{

    private $conn; // database connection
    private $table_name = "ENTRADA"; //taula

    // properties


    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    // mètodes

    function getEntrades(){
        $query = "SELECT PK_FK_ID_ENTRADA_ESDEVENIMENT, PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ENTRADA";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function insertEntrada($id_esdeveniment, $descompte){
        $result = "SELECT MAX(PK_NUMERO_ENTRADA) FROM ENTRADA WHERE PK_FK_ID_ENTRADA_ESDEVENIMENT = $id_esdeveniment";  
        $stm1 = $this->conn->prepare($result);
        $result = $stm1->execute();
        while($row=$stm1->fetch()){ //for each result, do the following
            $max=$row['MAX(PK_NUMERO_ENTRADA)'];
       }
       $max = $max+1;

        $query = "INSERT INTO ENTRADA (PK_FK_ID_ENTRADA_ESDEVENIMENT, PK_NUMERO_ENTRADA, DESCOMPTE) VALUES ($id_esdeveniment, $max, $descompte)";
        $stm2 = $this->conn->prepare($query);
        $stm2->execute();
        return $stm2;
    }

    function deleteEntrada($id_esdeveniment, $id_entrada) {
        $query = "DELETE FROM ENTRADA WHERE PK_FK_ID_ENTRADA_ESDEVENIMENT=$id_esdeveniment AND PK_NUMERO_ENTRADA=$id_entrada";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }
}
?>
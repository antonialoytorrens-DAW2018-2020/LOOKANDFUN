<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.php");
require_once ("$base/config/db.const.php");
class Event{

    private $conn; // database connection
    private $table_name = "ESDEVENIMENT"; //taula

    // properties


    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    // mètodes

    function getAll(){
        $query = "SELECT PK_ID_ESDEVENIMENT, NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, AFORAMENT, OCUPACIO, PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, ESDEVENIMENT.FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ESDEVENIMENT INNER JOIN ENTRADA ON ESDEVENIMENT.PK_ID_ESDEVENIMENT = ENTRADA.PK_FK_ID_ENTRADA_ESDEVENIMENT";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function getEsdeveniments(){
        $query = "SELECT PK_ID_ESDEVENIMENT, NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, FK_CODI_RECINTE, AFORAMENT, OCUPACIO, SOURCE_POSTER_EVENT FROM ESDEVENIMENT";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function getEsdeveniment($id) {
        $query = "SELECT PK_ID_ESDEVENIMENT, NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, FK_CODI_RECINTE, AFORAMENT, OCUPACIO, SOURCE_POSTER_EVENT FROM ESDEVENIMENT WHERE PK_ID_ESDEVENIMENT=$id";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function updateEsdeveniment($id, $nom, $descripcio, $data_inici, $data_fi, $preu, $recinte, $aforament, $ocupacio, $poster) {
        $query = "UPDATE ESDEVENIMENT SET NOM='$nom', DESCRIPCIO='$descripcio', DATA_INICI = '$data_inici', DATA_FI = '$data_fi', PREU = '$preu', FK_CODI_RECINTE = '$recinte', AFORAMENT = '$aforament', OCUPACIO = '$ocupacio', SOURCE_POSTER_EVENT = '$poster' WHERE PK_ID_ESDEVENIMENT='$id'";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function deleteEsdeveniment($id) {
        $query = "DELETE FROM ESDEVENIMENT WHERE PK_ID_ESDEVENIMENT=$id";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function insertEsdeveniment($nom, $descripcio, $data_inici, $data_fi, $preu, $aforament, $poster, $recinte) {
        $query = "INSERT INTO ESDEVENIMENT (NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, AFORAMENT, SOURCE_POSTER_EVENT, FK_CODI_RECINTE) VALUES ('$nom', '$descripcio', '$data_inici', '$data_fi', '$preu', '$aforament', '$poster', '$recinte')";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    function readOne(){
        $query = "SELECT NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, FK_CODI_RECINTE, AFORAMENT, OCUPACIO, SOURCE_POSTER_EVENT FROM ESDEVENIMENT WHERE PK_ID_ESDEVENIMENT= ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id_event); //L'he rebut per get desde s'API
        $stmt->execute();
        return $stmt;
    }
}
?>
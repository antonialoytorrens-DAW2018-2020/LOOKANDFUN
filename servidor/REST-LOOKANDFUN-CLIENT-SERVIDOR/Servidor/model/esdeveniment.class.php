<?php
$base = __DIR__ . '/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");

class Esdeveniment
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta

    //Atributs
    public $PK_ID_ESDEVENIMENT;
    public $NOM;
    public $DESCRIPCIO;
    public $DATA_INICI;
    public $DATA_FI;
    public $PREU;
    public $AFORAMENT;
    public $OCUPACIO;

    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby = "PK_ID_ESDEVENIMENT")
    {
        try {
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM ESDEVENIMENT ORDER BY $orderby");
            $stm->execute();
            $tuples = $stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
            $this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;
        } catch (Exception $e) {   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }

    public function get($id)
    {
        try {
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM ESDEVENIMENT where PK_ID_ESDEVENIMENT=:PK_ID_ESDEVENIMENT");
            $stm->bindValue(':PK_ID_ESDEVENIMENT', $id);
            $stm->execute();
            $tupla = $stm->fetch();
            $this->resposta->setDades($tupla);    // array de tuples
            $this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;
        } catch (Exception $e) {   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }


    function insert(){
        try {
            $query = "INSERT INTO
                ESDEVENIMENT
            SET
                NOM=:NOM, DESCRIPCIO=:DESCRIPCIO, DATA_INICI=:DATA_INICI, DATA_FI=:DATA_FI, PREU=:PREU, AFORAMENT=:AFORAMENT, FK_CODI_RECINTE=:FK_CODI_RECINTE ";

            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->NOM=htmlspecialchars(strip_tags($this->NOM));
            $this->DESCRIPCIO=htmlspecialchars(strip_tags($this->DESCRIPCIO));
            $this->DATA_INICI=htmlspecialchars(strip_tags($this->DATA_INICI));
            $this->DATA_FI=htmlspecialchars(strip_tags($this->DATA_FI));
            $this->PREU=htmlspecialchars(strip_tags($this->PREU));
            $this->AFORAMENT=htmlspecialchars(strip_tags($this->AFORAMENT));
            $this->FK_CODI_RECINTE=htmlspecialchars(strip_tags($this->FK_CODI_RECINTE));
            //////
            // bind values
            $stmt->bindParam(":NOM", $this->NOM);
            $stmt->bindParam(":DESCRIPCIO", $this->DESCRIPCIO);
            $stmt->bindParam(":DATA_INICI", $this->DATA_INICI);
            $stmt->bindParam(":DATA_FI", $this->DATA_FI);
            $stmt->bindParam(":PREU", $this->PREU);
            $stmt->bindParam(":AFORAMENT", $this->AFORAMENT);
            $stmt->bindParam(":FK_CODI_RECINTE",$this->FK_CODI_RECINTE);
            ///////////
            //$stmt->bindParam(":poster", $poster, PDO::PARAM_LOB);
            // execute query
            $stmt->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error borrant: " . $e->getMessage());
            return $this->resposta;
        }
    }

    public function update($data)
    {
        try {

            $PK_ID_ESDEVENIMENT = $data['PK_ID_ESDEVENIMENT'];

            $sql = "UPDATE AUTORS SET (NOM, DESCRIPCIO, DATA_INICI, DATA_FI, PREU, AFORAMENT, FK_CODI_RECINTE) VALUES (:NOM,:DESCRIPCIO,:DATA_INICI,:DATA_FI,:PREU,:AFORAMENT,:FK_CODI_RECINTE) WHERE PK_ID_ESDEVENIMENT=:PK_ID_ESDEVENIMENT";

            $NOM = $data['NOM'];
            $DESCRIPCIO = $data['DESCRIPCIO'];
            $DATA_INICI = $data['DATA_INICI'];
            $DATA_FI = $data['DATA_FI'];
            $PREU = $data['PREU'];
            $AFORAMENT = $data['AFORAMENT'];
            $FK_CODI_RECINTE = $data['FK_CODI_RECINTE'];

            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':PK_ID_ESDEVENIMENT', $PK_ID_ESDEVENIMENT);
            $stm->bindValue(':NOM', $NOM);
            $stm->bindValue(':DESCRIPCIO', $DESCRIPCIO);
            $stm->bindValue(':DATA_INICI', $DATA_INICI);
            $stm->bindValue(':DATA_FI', $DATA_FI);
            $stm->bindValue(':PREU', $PREU);
            $stm->bindValue(':AFORAMENT', $AFORAMENT);
            $stm->bindValue(':FK_CODI_RECINTE', $FK_CODI_RECINTE);
            $stm->execute();

            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error actualitzant: " . $e->getMessage() . $sql);
            return $this->resposta;
        }
    }



    public function delete($id)
    {
        try {
            $sql = "DELETE FROM ESDEVENIMENT WHERE PK_ID_ESDEVENIMENT=$id";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error borrant: " . $e->getMessage());
            return $this->resposta;
        }
    }


    public function filtra($where, $orderby, $offset, $count)
    {
        try {
            $where = $_GET["where"];
            $orderby = $_GET["orderby"];
            $count = $_GET["count"];
            $offset = $_GET["offset"];

            $sql = "SELECT * FROM AUTORS WHERE :wh ORDER BY :orderby LIMIT :count OFFSET :offset";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':wh', $where);
            $stm->bindValue(':orderby', $orderby);
            $stm->bindValue(':count', $count, PDO::PARAM_INT);
            $stm->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stm->execute();
            $tuples = $stm->fetchAll();
            $this->resposta->setDades($tuples);
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error filtrant: " . $e->getMessage());
            return $this->resposta;
        }
    }
}

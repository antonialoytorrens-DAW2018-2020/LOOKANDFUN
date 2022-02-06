<?php
namespace App\Model;
use App\Lib\Database;
use App\Lib\Resposta;
use PDO;
use Exception;

class Esdeveniment
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   //resposta

    //Atributs
    public $PK_ID_ESDEVENIMENT;
    public $NOM;
    public $DESCRIPCIO;
    public $DATA_INICI;
    public $DATA_FI;
    public $PREU;
    public $AFORAMENT;
    public $FK_CODI_RECINTE;
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


    function insert($data){
        try {
            $NOM = $data['NOM'];
            $DESCRIPCIO=$data['DESCRIPCIO'];
            $DATA_INICI=$data['DATA_INICI'];
            $DATA_FI=$data['DATA_FI'];
            $PREU=$data['PREU'];
            $AFORAMENT=$data['AFORAMENT'];
            $FK_CODI_RECINTE=$data['FK_CODI_RECINTE'];

            $sql = "INSERT INTO ESDEVENIMENT
                            (NOM,DESCRIPCIO,DATA_INICI,DATA_FI,PREU,AFORAMENT,FK_CODI_RECINTE)
                            VALUES (:NOM,:DESCRIPCIO,:DATA_INICI,:DATA_FI,:PREU,:AFORAMENT,:FK_CODI_RECINTE)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':NOM',$NOM);
            $stm->bindValue(':DESCRIPCIO',$DESCRIPCIO);
            $stm->bindValue(':DATA_INICI',$DATA_INICI);
            $stm->bindValue(':DATA_FI',$DATA_FI);
            $stm->bindValue(':PREU',$PREU);
            $stm->bindValue(':AFORAMENT',$AFORAMENT);
            $stm->bindValue(':FK_CODI_RECINTE',$FK_CODI_RECINTE);
            $stm->execute();
            // execute query
            $stm->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error insertant: " . $e->getMessage());
            return $this->resposta;
        }
    }

    public function update($data)
    {
        try {

            $PK_ID_ESDEVENIMENT = $data['id'];
            $NOM = $data['NOM'];
            $DESCRIPCIO = $data['DESCRIPCIO'];
            $DATA_INICI = $data['DATA_INICI'];
            $DATA_FI = $data['DATA_FI'];
            $PREU = $data['PREU'];
            $AFORAMENT = $data['AFORAMENT'];
            $FK_CODI_RECINTE = $data['FK_CODI_RECINTE'];

            $sql = "UPDATE ESDEVENIMENT SET NOM=:NOM, DESCRIPCIO=:DESCRIPCIO, DATA_INICI=:DATA_INICI, DATA_FI=:DATA_FI, PREU=:PREU, AFORAMENT=:AFORAMENT, FK_CODI_RECINTE=:FK_CODI_RECINTE WHERE PK_ID_ESDEVENIMENT=:PK_ID_ESDEVENIMENT";

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
}

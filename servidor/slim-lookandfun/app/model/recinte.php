<?php
namespace App\Model;
use App\Lib\Database;
use App\Lib\Resposta;
use PDO;
use Exception;

class recinte
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   //resposta

    public $PK_CODI_RECINTE;
    public $NOM_RECINTE;
    public $DIRECCIO;
    public $CAPACITAT;

    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby = "PK_CODI_RECINTE")
    {
        try {
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM RECINTE ORDER BY $orderby");
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
            $stm = $this->conn->prepare("SELECT * FROM RECINTE where PK_CODI_RECINTE=:PK_CODI_RECINTE");
            $stm->bindValue(':PK_CODI_RECINTE', $id);
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
            $NOM_RECINTE = $data['NOM_RECINTE'];
            $DIRECCIO=$data['DIRECCIO'];
            $CAPACITAT=$data['CAPACITAT'];

            $sql = "INSERT INTO RECINTE
                            (NOM_RECINTE, DIRECCIO, CAPACITAT)
                            VALUES (:NOM_RECINTE,:DIRECCIO,:CAPACITAT)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':NOM_RECINTE',$NOM_RECINTE);
            $stm->bindValue(':DIRECCIO',$DIRECCIO);
            $stm->bindValue(':CAPACITAT',$CAPACITAT);
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
            $PK_CODI_RECINTE = $data['id'];

            $NOM_RECINTE = $data['NOM_RECINTE'];
            $DIRECCIO=$data['DIRECCIO'];
            $CAPACITAT=$data['CAPACITAT'];

            $sql = "UPDATE RECINTE SET NOM_RECINTE=:NOM_RECINTE, DIRECCIO=:DIRECCIO, CAPACITAT=:CAPACITAT WHERE PK_CODI_RECINTE=:PK_CODI_RECINTE";

            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':PK_CODI_RECINTE', $PK_CODI_RECINTE);

            $stm->bindValue(':NOM_RECINTE', $NOM_RECINTE);
            $stm->bindValue(':DIRECCIO', $DIRECCIO);
            $stm->bindValue(':CAPACITAT', $CAPACITAT);
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
            $sql = "DELETE FROM RECINTE WHERE PK_CODI_RECINTE=$id";
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
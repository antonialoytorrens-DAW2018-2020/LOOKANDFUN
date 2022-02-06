<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Resposta;
use PDO;
use Exception;

class TipusEsdeveniment {
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta

    public function __CONSTRUCT(){
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby="PK_FK_CODI_TIPUS"){
        try{
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM TIPUS_ESDEVENIMENT ORDER BY $orderby");
            $stm->execute();
            $tuples=$stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
            $this->resposta->setCorrecta(true);       // La resposta es correcta
            return $this->resposta;
        }
        catch(Exception $e){   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }

    public function get($id){
        try{
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM TIPUS_ESDEVENIMENT 
                                                    where PK_FK_CODI_TIPUS=:PK_FK_CODI_TIPUS OR PK_FK_ID_TIPUS_ESDEVENIMENT=:PK_FK_ID_TIPUS_ESDEVENIMENT");
            $stm->bindValue(':PK_FK_CODI_TIPUS',$id);
            $stm->bindValue(':PK_FK_ID_TIPUS_ESDEVENIMENT',$id);
            $stm->execute();
            $tupla=$stm->fetchAll();
            $this->resposta->setDades($tupla);    // array de tuples
            $this->resposta->setCorrecta(true);       // La resposta es correcta
            return $this->resposta;
        }
        catch(Exception $e){   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }

    public function filtra($where, $orderby, $offset, $count){
        try {
            $where = $_GET["where"];
            $orderby = $_GET["orderby"];
            $count = $_GET["count"];
            $offset = $_GET["offset"];

            $sql = "SELECT * FROM TIPUS_ESDEVENIMENT  WHERE :wh ORDER BY :oby LIMIT :cnt OFFSET :offs";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':wh', $where);
            $stm->bindValue(':oby', $orderby);
            $stm->bindValue(':cnt', $count, PDO::PARAM_INT);
            $stm->bindValue(':offs', $offset, PDO::PARAM_INT);
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



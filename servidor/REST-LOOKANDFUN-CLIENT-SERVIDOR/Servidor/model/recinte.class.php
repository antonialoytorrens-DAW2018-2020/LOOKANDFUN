<?php
$base = __DIR__.'/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");

class Recinte {
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta

    public function __CONSTRUCT(){
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby="PK_CODI_RECINTE"){
        try{
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM RECINTE ORDER BY $orderby");
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
            $stm = $this->conn->prepare("SELECT * FROM RECINTE where PK_CODI_RECINTE=:PK_CODI_RECINTE");
            $stm->bindValue(':PK_CODI_RECINTE',$id);
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

    public function insert($data){
        try{
            $nom=$data['NOM_RECINTE'];
            $direccio=$data['DIRECCIO'];
            $capacitat=$data['CAPACITAT'];


            $sql = "INSERT INTO RECINTE
                            (NOM_RECINTE ,DIRECCIO,CAPACITAT)
                            VALUES (:nom,:direccio,:capacitat)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':nom',$nom);
            $stm->bindValue(':direccio',$direccio);
            $stm->bindValue(':capacitat',$capacitat);
            $stm->execute();

            $this->resposta->setCorrecta(true);
            return $this->resposta;
        }
        catch (Exception $e){
            $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
            return $this->resposta;
        }
    }

    public function update($data){
        try
        {
            $codi = $data['PK_CODI_RECINTE'];
            $nom=$data['NOM_RECINTE'];
            $direccio=$data['DIRECCIO'];
            $capacitat=$data['CAPACITAT'];

            $sql = "UPDATE RECINTE
                        SET NOM_RECINTE = :nom, DIRECCIO = :direccio, CAPACITAT = :capacitat
                            WHERE PK_CODI_RECINTE = :codi";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':codi',$codi);
            $stm->bindValue(':nom',$nom);
            $stm->bindValue(':direccio',$direccio);
            $stm->bindValue(':capacitat',$capacitat);
            $stm->execute();

            $this->resposta->setCorrecta(true);
            return $this->resposta;
        }
        catch (Exception $e)
        {
            $this->resposta->setCorrecta(false, "Error modificant: ".$e->getMessage());
            return $this->resposta;
        }
    }

    public function delete($id){
        try {
            $sql = "DELETE FROM RECINTE WHERE PK_CODI_RECINTE = $id";
            $stm = $this->conn->prepare($sql);
            $stm->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error borrant: " . $e->getMessage());
            return $this->resposta;
        }
    }

    public function filtra($where, $orderby, $offset, $count){
        try {
            $where = $_GET["where"];
            $orderby = $_GET["orderby"];
            $count = $_GET["count"];
            $offset = $_GET["offset"];

            $sql = "SELECT * FROM RECINTE  WHERE :wh ORDER BY :oby LIMIT :cnt OFFSET :offs";
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

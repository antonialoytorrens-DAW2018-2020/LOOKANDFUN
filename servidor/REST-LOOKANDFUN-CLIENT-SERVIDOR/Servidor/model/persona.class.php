<?php
$base = __DIR__.'/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");

class Persona {
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta

    public function __CONSTRUCT(){
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby="PK_CODI_PERSONA"){
        try{
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM PERSONA ORDER BY $orderby");
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
            $stm = $this->conn->prepare("SELECT * FROM PERSONA where PK_CODI_PERSONA=:PK_CODI_PERSONA");
            $stm->bindValue(':PK_CODI_PERSONA',$id);
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
            $identificacio = $data['DNI'];
            $nom=$data['NOM'];
            $llinatges=$data['LLINATGES'];
            $tlf=$data['TELEFON'];
            $email=$data['EMAIL'];
            $dataN=$data['DATA_NAIXEMENT'];

            $sql = "INSERT INTO PERSONA
                            (DNI,NOM,LLINATGES,TELEFON,EMAIL,DATA_NAIXEMENT)
                            VALUES (:identificacio,:nom,:llinatges,:tlf,:email,:dataN)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':identificacio',$identificacio);
            $stm->bindValue(':nom',$nom);
            $stm->bindValue(':llinatges',$llinatges);
            $stm->bindValue(':tlf',$tlf);
            $stm->bindValue(':email',$email);
            $stm->bindValue(':dataN',!empty($dataN)?$dataN:NULL,PDO::PARAM_STR);
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
            $codi = $data['PK_CODI_PERSONA'];
            $identificacio = $data['DNI'];
            $nom=$data['NOM'];
            $llinatges=$data['LLINATGES'];
            $tlf=$data['TELEFON'];
            $email=$data['EMAIL'];
            $dataN=$data['DATA_NAIXEMENT'];

            $sql = "UPDATE PERSONA
                        SET DNI = :identificacio, NOM = :nom, LLINATGES = :llinatges, TELEFON = :tlf, EMAIL = :email, DATA_NAIXEMENT = :dataN
                            WHERE PK_CODI_PERSONA = :codi";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':codi',$codi);
            $stm->bindValue(':identificacio',$identificacio);
            $stm->bindValue(':nom',$nom);
            $stm->bindValue(':llinatges',$llinatges);
            $stm->bindValue(':tlf',$tlf);
            $stm->bindValue(':email',$email);
            $stm->bindValue(':dataN',!empty($dataN)?$dataN:NULL,PDO::PARAM_STR);
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
            $sql = "DELETE FROM PERSONA WHERE PK_CODI_PERSONA = $id";
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

            $sql = "SELECT * FROM PERSONA  WHERE :wh ORDER BY :oby LIMIT :cnt OFFSET :offs";
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

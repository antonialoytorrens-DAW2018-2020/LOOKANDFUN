<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.class.php");
require_once("$base/config/db.const.php");
class Entrada{

    private $conn; // database connection
    private $table_name = "ENTRADA"; //taula

    // properties


    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }

    // mètodes

    function getEntrades($orderby = "PK_NUMERO_ENTRADA"){
        $query = "SELECT PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ENTRADA ORDER BY $orderby";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        return $stm;
    }

    public function get($id){
        try{
            $result = array();
            $stm = $this->conn->prepare("SELECT PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ENTRADA WHERE PK_NUMERO_ENTRADA=:PK_NUMERO_ENTRADA");
            $stm->bindValue(':PK_NUMERO_ENTRADA',$id);
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
            $id_entrada_esdeveniment = $data['PK_FK_ID_ENTRADA_ESDEVENIMENT'];
            $descompte = $data['DESCOMPTE'];
            $data_entrada=$data['DATA_ENTRADA'];
            $codi_persona=$data['FK_CODI_PERSONA'];
            $codi_recinte=$data['FK_CODI_RECINTE'];
            $fila_butaca=$data['FK_FILA_BUTACA'];
            $numero_butaca=$data['FK_NUMERO_BUTACA'];

            $sql = "INSERT INTO ENTRADA
                            (PK_FK_ID_ENTRADA_ESDEVENIMENT, DESCOMPTE,DATA_ENTRADA,FK_CODI_PERSONA,FK_CODI_RECINTE,FK_FILA_BUTACA,FK_NUMERO_BUTACA)
                            VALUES (:id_entrada_esdeveniment,:descompte,:data_entrada,:codi_persona,:codi_recinte,:fila_butaca,:numero_butaca)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':id_entrada_esdeveniment', $id_entrada_esdeveniment);
            $stm->bindValue(':descompte', $descompte);
            $stm->bindValue(':data_entrada',$data_entrada);
            $stm->bindValue(':codi_persona',$codi_persona);
            $stm->bindValue(':codi_recinte',$codi_recinte);
            $stm->bindValue(':fila_butaca',!empty($fila_butaca)?$fila_butaca:NULL,PDO::PARAM_INT);
            $stm->bindValue(':numero_butaca',!empty($numero_butaca)?$numero_butaca:NULL,PDO::PARAM_INT);
            $stm->execute();

            $this->resposta->setCorrecta(true);
            return $this->resposta;
        }
        catch (Exception $e){
            $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
            return $this->resposta;
        }
    }

    /*public function update($data){
        try
        {
            $codi_entrada = $data['PK_NUMERO_ENTRADA'];
            $descompte = $data['DESCOMPTE'];
            $data_entrada=$data['DATA_ENTRADA'];
            $codi_persona=$data['FK_CODI_PERSONA'];
            $codi_recinte=$data['FK_CODI_RECINTE'];
            $fila_butaca=$data['FK_FILA_BUTACA'];
            $numero_butaca=$data['FK_NUMERO_BUTACA'];

            $sql = "UPDATE ENTRADA
                        SET PK_NUMERO_ENTRADA = :identificacio, NOM = :nom, LLINATGES = :llinatges, TELEFON = :tlf, EMAIL = :email, DATA_NAIXEMENT = :dataN
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
        }*/

        /* NO ÉS CONVENIENT ACTUALITZAR ENTRADES, SOBRETOT SI SÓN DE PAGAMENT*/
    //}

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM ENTRADA WHERE PK_NUMERO_ENTRADA = $id";
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

            $sql = "SELECT * FROM ENTRADA  WHERE :wh ORDER BY :oby LIMIT :cnt OFFSET :offs";
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
?>
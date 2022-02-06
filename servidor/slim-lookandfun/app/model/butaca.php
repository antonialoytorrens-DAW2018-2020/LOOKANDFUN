<?php
namespace App\Model;
use App\Lib\Database;
use App\Lib\Resposta;
use PDO;
use Exception;


class butaca
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   //resposta

    public $PK_FK_CODI_RECINTE;
    public $PK_FILA_BUTACA;
    public $PK_NUMERO_BUTACA;

    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    public function getAll($orderby = "PK_FK_CODI_RECINTE")
    {
        try {
            $result = array();
            $stm = $this->conn->prepare("SELECT * FROM BUTACA ORDER BY $orderby");
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

    public function getByRecinte($id)
    {
        try {
            $stm = $this->conn->prepare("SELECT * FROM BUTACA where PK_FK_CODI_RECINTE=:PK_FK_CODI_RECINTE");
            $stm->bindValue(':PK_FK_CODI_RECINTE', $id);
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

    /*function insert($data){
        try {
            $PK_FK_CODI_RECINTE = $data['PK_FK_CODI_RECINTE'];
            $PK_FILA_BUTACA = $data['PK_FILA_BUTACA'];
            $PK_NUMERO_BUTACA = $data['PK_NUMERO_BUTACA'];

            $sql = "INSERT INTO BUTACA
                            (PK_FK_CODI_RECINTE, PK_FILA_BUTACA, PK_NUMERO_BUTACA)
                            VALUES (:PK_FK_CODI_RECINTE,:PK_FILA_BUTACA,:PK_NUMERO_BUTACA)";

            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':PK_FK_CODI_RECINTE',$PK_FK_CODI_RECINTE);
            $stm->bindValue(':PK_FILA_BUTACA',$PK_FILA_BUTACA);
            $stm->bindValue(':PK_NUMERO_BUTACA',$PK_NUMERO_BUTACA);
            $stm->execute();
            // execute query
            $stm->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error insertant: " . $e->getMessage());
            return $this->resposta;
        }
    }*/

    function superInsert($data){
        try {
            $PK_CODI_RECINTE = $data['id'];
            $PK_FK_CODI_RECINTE = $data['id'];
            $files = $data['numFiles'];

            $stm = $this->conn->prepare("SELECT CAPACITAT FROM RECINTE where PK_CODI_RECINTE=:PK_CODI_RECINTE");
            $stm->bindValue(':PK_CODI_RECINTE',$PK_CODI_RECINTE);
            $stm->execute();
            $tupla = $stm->fetch();
            $capacitat = $tupla['CAPACITAT'];

            $butaquesPerFila = $capacitat/$files;
            $sql = "INSERT INTO BUTACA
                            (PK_FK_CODI_RECINTE, PK_FILA_BUTACA, PK_NUMERO_BUTACA)
                            VALUES (:PK_FK_CODI_RECINTE,:PK_FILA_BUTACA,:PK_NUMERO_BUTACA)";

            $stm=$this->conn->prepare($sql);
            for($i = 1; $i <= $files; $i++){
                for($j = 1; $j <= $butaquesPerFila; $j++){

                    $stm->bindValue(':PK_FK_CODI_RECINTE',$PK_FK_CODI_RECINTE);
                    $stm->bindValue(':PK_FILA_BUTACA',$i);
                    $stm->bindValue(':PK_NUMERO_BUTACA',$j);
                    $stm->execute();
                    // execute query

                }
            }

            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error insertant: " . $e->getMessage());
            return $this->resposta;
        }
    }

    /*Updatear claus primaries es impossible*/

    /*delete massiu hauria de ser ONCASCADE quan feim delete de 1 Recinte*/
    /*Delete particular*/
    public function delete($data)
    {
        try {
            $PK_FK_CODI_RECINTE = $data['id'];
            $PK_FILA_BUTACA = $data['PK_FILA_BUTACA'];
            $PK_NUMERO_BUTACA = $data['PK_NUMERO_BUTACA'];

            $sql = "DELETE FROM BUTACA WHERE PK_FK_CODI_RECINTE=:PK_FK_CODI_RECINTE and PK_FILA_BUTACA=:PK_FILA_BUTACA and PK_NUMERO_BUTACA=:PK_NUMERO_BUTACA";
            $stm = $this->conn->prepare($sql);

            $stm->bindValue(':PK_FK_CODI_RECINTE', $PK_FK_CODI_RECINTE);
            $stm->bindValue(':PK_FILA_BUTACA', $PK_FILA_BUTACA);
            $stm->bindValue(':PK_NUMERO_BUTACA', $PK_NUMERO_BUTACA);

            $stm->execute();
            $this->resposta->setCorrecta(true);
            return $this->resposta;
        } catch (Exception $e) {
            $this->resposta->setCorrecta(false, "Error borrant: " . $e->getMessage());
            return $this->resposta;
        }
    }






}
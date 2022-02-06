<?php

namespace App\Model;

use App\Lib\Database;
use App\Lib\Resposta;
use PDO;
use Exception;

class Entrada
{

    private $conn; // database connection
    private $resposta;   // resposta
    private $table_name = "ENTRADA"; //taula

    // properties


    // constructor
    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->resposta = new Resposta();
    }

    // mètodes

    function getAll($orderby = "PK_NUMERO_ENTRADA")
    {
        try {
            $query = "SELECT PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ENTRADA ORDER BY $orderby";
            $stm = $this->conn->prepare($query);
            $stm->execute();
            $tupla = $stm->fetchAll();
            $this->resposta->setDades($tupla);    // array de tuples
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
            $stm = $this->conn->prepare("SELECT PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ENTRADA WHERE PK_NUMERO_ENTRADA=:PK_NUMERO_ENTRADA");
            $stm->bindValue(':PK_NUMERO_ENTRADA', $id);
            $stm->execute();
            $tupla = $stm->fetchAll();
            $this->resposta->setDades($tupla);    // array de tuples
            $this->resposta->setCorrecta(true);       // La resposta es correcta
            return $this->resposta;
        } catch (Exception $e) {   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }
    function insert($id_esdeveniment, $descompte)
    {
        try {
            $result = "SELECT MAX(PK_NUMERO_ENTRADA) FROM ENTRADA WHERE PK_FK_ID_ENTRADA_ESDEVENIMENT = $id_esdeveniment";
            $stm1 = $this->conn->prepare($result);
            $result = $stm1->execute();
            while ($row = $stm1->fetch()) { //for each result, do the following
                $max = $row['MAX(PK_NUMERO_ENTRADA)'];
            }
            $max = $max + 1;

            $query = "INSERT INTO ENTRADA (PK_FK_ID_ENTRADA_ESDEVENIMENT, PK_NUMERO_ENTRADA, DESCOMPTE) VALUES ($id_esdeveniment, $max, $descompte)";
            $stm2 = $this->conn->prepare($query);
            $stm2->execute();
            return $stm2;
        } catch (Exception $e) {   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }

    function delete($id_esdeveniment, $id_entrada)
    {
        try {
            $query = "DELETE FROM ENTRADA WHERE PK_FK_ID_ENTRADA_ESDEVENIMENT='$id_esdeveniment' AND PK_NUMERO_ENTRADA='$id_entrada'";
            $stm2 = $this->conn->prepare($query);
            $stm2->execute();
            return $stm2;
        } catch (Exception $e) {   // hi ha un error posam la resposta a fals i tornam missatge d'error
            $this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
        }
    }
}

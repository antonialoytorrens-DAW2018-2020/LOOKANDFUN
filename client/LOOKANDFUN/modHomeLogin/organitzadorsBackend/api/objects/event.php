<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$base = __DIR__ . '/..';
require_once("$base/lib/database.php");
require_once ("$base/config/db.const.php");
class Event{

    private $conn; // database connection
    private $table_name = "events"; //taula

    //properties
    public $id_event; //Empleat per Desplegar 1 Full (el pas per GET)
    public $nom_event;
    public $nom_org;
    public $nom_cat;
    public $desc_event;
    //public $poster;
    public $data_event;
    public $tipus_event;
    public $aforo;
    public $source_poster_event;
    public $poster_ext;

    public $fk_id_cat;
    public $fk_id_org;

    // constructor
    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
    }
    // read *
    function readAll(){

        // select all query
        $query = "SELECT
                e.id_event, e.nom_event, c.nom_cat, o.nom_org, e.desc_event, e.data_event
            FROM
                " . $this->table_name . " e
                LEFT JOIN
                    categories c
                        ON e.fk_id_cat = c.id_cat
                LEFT JOIN
                    organitzadors o
                        ON e.fk_id_org = o.id_org
            ORDER BY
                e.id_event DESC"; //

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //$stmt->bindColumn(5, $poster, PDO::PARAM_LOB); //so far this has been useless but keep it in mind si mai passam sa foto

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create 1
    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                nom_event=:nom_event, desc_event=:desc_event, fk_id_org=:fk_id_org, fk_id_cat=:fk_id_cat, privat=:tipus_event, data_event=:data_event, aforo=:aforo";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->nom_event));
        $this->desc_event=htmlspecialchars(strip_tags($this->desc_event));
        $this->fk_id_org=htmlspecialchars(strip_tags($this->fk_id_org));
        $this->fk_id_cat=htmlspecialchars(strip_tags($this->fk_id_cat));
        $this->tipus_event=htmlspecialchars(strip_tags($this->tipus_event));
        $this->data_event=htmlspecialchars(strip_tags($this->data_event));
        //////
        // bind values
        $stmt->bindParam(":nom_event", $this->nom_event);
        $stmt->bindParam(":desc_event", $this->desc_event);
        $stmt->bindParam(":fk_id_cat", $this->fk_id_cat);
        $stmt->bindParam(":fk_id_org", $this->fk_id_org);
        $stmt->bindParam(":tipus_event", $this->tipus_event);
        $stmt->bindParam(":data_event", $this->data_event);
        $stmt->bindParam(":aforo",$this->aforo);

        ///////////
        //$stmt->bindParam(":poster", $poster, PDO::PARAM_LOB);
        // execute query
        if($stmt->execute()){
            $last_id = $this->conn->lastInsertId();
            $query = "UPDATE
            events    
            SET
                source_poster_event=:source_poster_event WHERE id_event= $last_id";

            /*$elderPath = $this->source_poster_event;
            $newPath = LAF_URL_IMG.$last_id.'.jpg';
            rename($elderPath,$newPath);
            $this->source_poster_event = $newPath;*/
            $path = pathinfo($this->poster_ext);
            $ext = $path['extension'];
            move_uploaded_file($this->source_poster_event, LAF_URL_IMG.$last_id.'.'.$ext);
            $newPath = LAF_URL_IMG.$last_id.'.'.$ext;
            $this->source_poster_event = $newPath;

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":source_poster_event",$this->source_poster_event);

            $stmt->execute();

            return true;
        }
        return false;
    }

    // read 1
    function readOne(){

        // query to read single record
        $query = "SELECT
                e.nom_event, c.nom_cat, o.nom_org, e.desc_event, e.data_event, e.source_poster_event
            FROM
                " . $this->table_name . " e
                LEFT JOIN
                    categories c
                        ON e.fk_id_cat = c.id_cat
                LEFT JOIN
                    organitzadors o
                        ON e.fk_id_org = o.id_org
            WHERE
                e.id_event = ?
            LIMIT
                0,1"; //Just in case use limit as 2xCheck (even tho' we r already filtering by id...

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id
        $stmt->bindParam(1, $this->id_event); //L¡he rebut per get desde s'API

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
?>
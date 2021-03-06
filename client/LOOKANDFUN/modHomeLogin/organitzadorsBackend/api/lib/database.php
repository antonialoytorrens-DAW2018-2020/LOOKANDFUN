<?php
$base = __DIR__ . '/..';
require_once("$base/config/db.const.php");

class Database {

  private static $instance = null;  //instancia(objecte) de la pròpia classe
  private $pdo;    //connexió a la base de dades
  private $host = LAF_HOST;
  private $user = LAF_USER;
  private $pass = LAF_PASS;
  private $dbname = LAF_BBDD;
  
  private function __construct() {
    $this->pdo = new PDO("mysql:host={$this->host}; dbname={$this->dbname}", $this->user,$this->pass,
                                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        // activam excepcions
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);     // per defecte fetch assoc
  }

  public static function getInstance() {
    // torna la instància, si aquesta no està creada la crea  
    if(!self::$instance) { 
        self::$instance = new Database();  
    }
    return self::$instance;
  }

  public function getConnection() {  
      return $this->pdo;  
  }
} 
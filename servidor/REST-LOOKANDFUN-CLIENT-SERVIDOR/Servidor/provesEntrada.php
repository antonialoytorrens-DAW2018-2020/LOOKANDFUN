<?php
$base = __DIR__;
require_once("$base/lib/resposta.class.php");
require_once("$base/model/entrada.class.php");

$entrada = new Entrada();

$entrada->insert(array(
    "PK_FK_ID_ENTRADA_ESDEVENIMENT" => 1,
    "DESCOMPTE" => 0,
    "DATA_ENTRADA" => "2019/12/17",
    "FK_CODI_PERSONA" => 1,
    "FK_CODI_RECINTE" => 1,
    "FK_FILA_BUTACA" => null,
    "FK_NUMERO_BUTACA" => null
));

//$entrada->delete(23);

//prueba get all

$prova = $entrada->getEntrades();

if ($prova->correcta) {
    foreach ($prova->dades as $row) {
        echo "CODI_ENTRADA = " . $row['PK_CODI_ENTRADA'] . "<br>DATA_ENTRADA = " . $row['DATA_ENTRADA'] .
            "<br>FK_CODI_PERSONA = " . $row['FK_CODI_PERSONA'] . "<br>FK_CODI_RECINTE = " . $row['FK_CODI_RECINTE'] .
            "<br>FILA_BUTACA = " . $row['FILA_BUTACA'] . "<br>NUMERO_BUTACA = " . $row['NUMERO_BUTACA'] . "<br>";
    }
} else {
    echo $prova->missatge;
}

//prueba get by id

/*$prova = $persona->get(16);

if ($prova->correcta) {
    foreach ($prova->dades as $row) {
        echo "ID = " . $row['PK_CODI_PERSONA'] . "<br>DNI = " . $row['DNI'] .
            "<br>NOM = " . $row['NOM'] . "<br>LLINATGES = " . $row['LLINATGES'] .
            "<br>EMAIL = " . $row['EMAIL'] . "<br>TELEFON = " . $row['TELEFON'] .
            "<br>DATA_NAIXEMENT = " . $row['DATA_NAIXEMENT'] . "<br><br>";
    }
} else {
    echo $prova->missatge;
}*/

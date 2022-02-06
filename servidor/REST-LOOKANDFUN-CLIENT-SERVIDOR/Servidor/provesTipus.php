<?php
$base = __DIR__;
require_once("$base/lib/resposta.class.php");
require_once("$base/model/tipus.class.php");

$tipus = new Tipus();

//$tipus->insert(array("NOM_TIPUS"=>"Comunion"));
//
//$tipus->update(array("PK_CODI_TIPUS"=>2,
//                     "NOM_TIPUS"=>"Concierto"));

$tipus->delete(3);

//prueba get all

$prova = $tipus->getAll();

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_TIPUS']."<br>NOM RECINTE = ".$row['NOM_TIPUS']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

//prueba get by id

$prova = $tipus->get(1);

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_TIPUS']."<br>NOM RECINTE = ".$row['NOM_TIPUS']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

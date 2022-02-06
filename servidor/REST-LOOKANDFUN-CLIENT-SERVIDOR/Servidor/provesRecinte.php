<?php
$base = __DIR__;
require_once("$base/lib/resposta.class.php");
require_once("$base/model/recinte.class.php");

$recinte = new Recinte();

//$recinte->insert(array("NOM_RECINTE"=>"Palau Sant Jordi",
//                       "DIRECCIO"=>"Av. Pepito El Catolico 1",
//                       "CAPACITAT"=>20000));
//
//$recinte->update(array("PK_CODI_RECINTE"=>2,
//                       "NOM_RECINTE"=>"Palma Arena",
//                       "DIRECCIO"=>"Av. Uruguay 3",
//                       "CAPACITAT"=>15000));

$recinte->delete(4);

//prueba get all

$prova = $recinte->getAll();

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_RECINTE']."<br>NOM RECINTE = ".$row['NOM_RECINTE'].
            "<br>DIRECCIO = ".$row['DIRECCIO']."<br>CAPACITAT = ".$row['CAPACITAT']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

//prueba get by id

$prova = $recinte->get(1);

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_RECINTE']."<br>NOM RECINTE = ".$row['NOM_RECINTE'].
            "<br>DIRECCIO = ".$row['DIRECCIO']."<br>CAPACITAT = ".$row['CAPACITAT']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

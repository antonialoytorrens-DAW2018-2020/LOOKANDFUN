<?php
$base = __DIR__;
require_once("$base/lib/resposta.class.php");
require_once("$base/model/persona.class.php");

$persona = new Persona();

//$persona->insert(array("DNI"=>"X4887522E" ,
//                       "NOM"=>"Juan Pablo",
//                       "LLINATGES"=>"Marquez Ortega",
//                       "TELEFON"=>652391023,
//                       "EMAIL"=>"juanpablomarquez@paucasesnovescifp.cat",
//                       "DATA_NAIXEMENT"=>"1998/12/07"));

//$persona->update(array("PK_CODI_PERSONA"=>16,
//                       "DNI"=>"A15575698",
//                       "NOM"=>"Antoni",
//                       "LLINATGES"=>"Aloy Torrens",
//                       "TELEFON"=>722568454,
//                       "EMAIL"=>"antonialoytorrens@paucasesnovescifp.cat",
//                       "DATA_NAIXEMENT"=>"2000/06/21"));

$persona->delete(23);

//prueba get all

$prova = $persona->getAll();

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_PERSONA']."<br>DNI = ".$row['DNI'].
            "<br>NOM = ".$row['NOM']."<br>LLINATGES = ".$row['LLINATGES'].
            "<br>EMAIL = ".$row['EMAIL']."<br>TELEFON = ".$row['TELEFON'].
            "<br>DATA_NAIXEMENT = ".$row['DATA_NAIXEMENT']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

//prueba get by id

$prova = $persona->get(16);

if ($prova-> correcta){
    foreach ($prova-> dades as $row){
        echo "ID = ".$row['PK_CODI_PERSONA']."<br>DNI = ".$row['DNI'].
            "<br>NOM = ".$row['NOM']."<br>LLINATGES = ".$row['LLINATGES'].
            "<br>EMAIL = ".$row['EMAIL']."<br>TELEFON = ".$row['TELEFON'].
            "<br>DATA_NAIXEMENT = ".$row['DATA_NAIXEMENT']."<br><br>";
    }
}else{
    echo $prova->missatge;
}

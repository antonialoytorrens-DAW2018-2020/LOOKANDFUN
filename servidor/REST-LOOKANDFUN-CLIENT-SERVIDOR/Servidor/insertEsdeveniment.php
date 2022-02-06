<?php
$base = __DIR__;
require_once("$base/model/esdeveniment.class.php");
require_once("$base/lib/resposta.class.php");

// initialize object
$event = new Esdeveniment();
//$data = json_decode(file_get_contents("php://input")); //Just go through $POST and $FILE

if(
    !empty($_POST['NOM']) &&
    !empty($_POST['DESCRIPCIO']) &&
    !empty($_POST['DATA_INICI']) &&
    !empty($_FILES['DATA_FI']) &&
    !empty($_POST['PREU']) &&
    !empty($_POST['AFORAMENT']) //&&
    //!empty($_POST['FK_CODI_RECINTE'])
){
    //Set data
    $event->NOM = $_POST['NOM'];
    $event->DESCRIPCIO = $_POST['DESCRIPCIO'];
    $event->DATA_INICI = $_POST['DATA_INICI'];
    $event->DATA_FI = $_POST['DATA_FI'];
    $event->PREU = $_POST['PREU'];
    $event->AFORAMENT = $_POST['AFORAMENT'];

    //obligat
    $event->FK_CODI_RECINTE = 1; //Per defecte enviarem el recinte 1
    // create the product
    if($event->insert()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
    // if unable to create the product, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
// tell the user data is incomplete
else{
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete.".print_r($_POST).print_r($_FILES)));
}
?>
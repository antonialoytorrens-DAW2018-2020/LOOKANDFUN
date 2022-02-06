<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header("Content-Type: image/png");

// include database and object files
include_once 'model/esdeveniment.class.php';

// instantiate database and product object
// initialize object
$event = new Esdeveniment();

// query products
// set ID property of record to read
$event->id_event = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$stmt = $event->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // create tupla
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
    $event_arr = array(
        "PK_ID_ESDEVENIMENT" => $PK_ID_ESDEVENIMENT,
        "NOM" => $NOM,
        "DESCRIPCIO" => $DESCRIPCIO,
        "DATA_INICI" => $DATA_INICI,
        "DATA_FI" => $DATA_FI,
        "PREU" => $PREU,
        "AFORAMENT" => $AFORAMENT,
        "FK_CODI_RECINTE" => $FK_CODI_RECINTE
    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($event_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>

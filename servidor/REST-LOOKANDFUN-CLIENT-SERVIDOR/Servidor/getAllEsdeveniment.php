<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: image/png"); //is this needed?

// include database and object files
include_once 'model/esdeveniment.class.php';


// initialize object
$event = new Esdeveniment();

// do query
$stmt = $event->getAll();

// check if more than 0 record found
$num = $stmt->rowCount();
if($num>0){
    // products array
    $events_arr=array();
    //$events_arr["records"]=array(); //Only usefull si volem es NESTED array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $event_item=array(
        "PK_ID_ESDEVENIMENT" => $PK_ID_ESDEVENIMENT,
        "NOM" => $NOM,
        "DESCRIPCIO" => $DESCRIPCIO,
        "DATA_INICI" => $DATA_INICI,
        "DATA_FI" => $DATA_FI,
        "PREU" => $PREU,
        "AFORAMENT" => $AFORAMENT,
        "FK_CODI_RECINTE" => $FK_CODI_RECINTE
        );
        //events_arr[records] si necessitam NESTEDS
        array_push($events_arr, $event_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($events_arr);
}

// if no products found
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user
    echo json_encode(
        array("message" => "No products found.")
    );
}
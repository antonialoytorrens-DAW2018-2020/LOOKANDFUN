<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: image/png"); //is this needed?

// include database and object files
include_once 'objects/event.php';


// initialize object
$event = new Event();

// do query
$stmt = $event->readAll();

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
            "id_event" => $id_event,
            "nom_event" => $nom_event,
            "nom_org" => $nom_org,
            "nom_cat" => $nom_cat,
            "data_event" => $data_event
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
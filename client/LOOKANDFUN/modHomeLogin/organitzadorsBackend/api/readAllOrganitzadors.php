<?php
//***************************//STILL IN PRODUCTION CS WE ARE NOT YET USING IT//*************************************************

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: image/png"); //is this needed?

// include database and object files
include_once 'objects/organitzador.php';

// instantiate database and product object
// initialize object
$organitzador = new Organitzador();

// query products
$stmt = $organitzador->readAll();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // products array
    $organitzadors_arr=array();
    //$events_arr["records"]=array(); //Only usefull si volem es NESTED array
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $organitzadors_item=array(
            "id_org" => $id_org,
            "nom_org" => $nom_org
        );
        //events_arr[records] si necessitam NESTEDS
        array_push($organitzadors_arr, $organitzadors_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($organitzadors_arr);
}

// no products found will be here
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
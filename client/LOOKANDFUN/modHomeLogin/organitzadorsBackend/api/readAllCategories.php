<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: image/png"); //is this needed?

// include database and object files
include_once 'objects/categoria.php';


// initialize object
$categoria = new Categoria();

// do query
$stmt = $categoria->readAll();
// check if more than 0 record found
$num = $stmt->rowCount();
if($num>0){
    // products array
    $categories_arr=array();
    //$events_arr["records"]=array(); //Only usefull si volem es NESTED array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $categoria_item=array(
            "id_cat" => $id_cat,
            "nom_cat" => $nom_cat
        );
        //events_arr[records] si necessitam NESTEDS
        array_push($categories_arr, $categoria_item);
    }

    // set response code - 200 OK
    http_response_code(200);
    // show products data in json format
    echo json_encode($categories_arr);
}

// if products found
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
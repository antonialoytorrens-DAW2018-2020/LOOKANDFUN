<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDE DATABASE AND OBJECT

include_once 'objects/event.php';

// INICIALIZE OBJECT

$event = new Event();
$statement = $event->getEsdeveniments();

// MORE THAN 0 ROWS

$num = $statement->rowCount();
if($num > 0) {
    $get_all_array = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $item = array(
            "id_esdeveniment" => $PK_ID_ESDEVENIMENT,
            "nom_esdeveniment" => $NOM,
            "descripcio_esdeveniment" => $DESCRIPCIO,
            "data_inici_esdeveniment" => $DATA_INICI,
            "data_final_esdeveniment" => $DATA_FI,
            "preu_esdeveniment" => $PREU,
            "codi_recinte_esdeveniment" => $FK_CODI_RECINTE,
            "aforament_esdeveniment" => $AFORAMENT,
            "ocupacio_esdeveniment" => $OCUPACIO,
            "poster_esdeveniment" => $SOURCE_POSTER_EVENT,
        );
        array_push($get_all_array, $item);
    }
    http_response_code(200);

    echo json_encode($get_all_array);
} else {
    http_response_code(404);

    echo json_encode(array("message" => "No s'han trobat esdeveniments"));
}

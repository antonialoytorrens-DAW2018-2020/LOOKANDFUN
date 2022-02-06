<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDE DATABASE AND OBJECT

include_once 'objects/event.php';

// INICIALIZE OBJECT

$event = new Event();
$statement = $event->getAll();

// MORE THAN 0 ROWS

$num = $statement->rowCount();
if($num > 0) {
    $get_all_array = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $item = array(
            "id_esdeveniment" => $PK_ID_ESDEVENIMENT,
            "nom_esdeveniment" => $NOM,
            "data_inici_esdeveniment" => $DATA_INICI,
            "data_final_esdeveniment" => $DATA_FI,
            "preu_esdeveniment" => $PREU,
            "aforament_esdeveniment" => $AFORAMENT,
            "ocupacio_esdeveniment" => $OCUPACIO,
            "id_entrada" => $PK_NUMERO_ENTRADA,
            "descompte_entrada" => $DESCOMPTE,
            "data_entrada" => $DATA_ENTRADA,
            "id_persona" => $FK_CODI_PERSONA,
            "codi_recinte_esdeveniment" => $FK_CODI_RECINTE,
            "fila_butaca" => $FK_FILA_BUTACA,
            "numero_butaca" => $FK_NUMERO_BUTACA
        );
        array_push($get_all_array, $item);
    }
    http_response_code(200);

    echo json_encode($get_all_array);
} else {
    http_response_code(404);

    echo json_encode(array("message" => "No s'han trobat esdeveniments"));
}

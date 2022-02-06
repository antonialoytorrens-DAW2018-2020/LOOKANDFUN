<?php
// INCLUDE DATABASE AND OBJECT

include_once 'objects/event.php';

$requiredFields = ["nom_esdeveniment", "descripcio_esdeveniment", "data_inici_esdeveniment", "data_final_esdeveniment", "preu_esdeveniment", "nom_recinte_esdeveniment", "aforament_esdeveniment"];
$allElementsSet = true;
foreach ($requiredFields as $requiredField) {
    /*
    // POSA NULL SI S'ENVIA ""
    if($_POST[$requiredField] == "") {
        $_POST[$requiredField] = null;
    }*/

    if (!isset($_POST[$requiredField]) && $_POST[$requiredField] != null) {
        $allElementsSet = false;
        break;
    }
}
if ($allElementsSet) {

    if ($_FILES['poster_esdeveniment']['size'] != 0) {
        // Move tmp file a api/resources/url_img
        $fileName = $_FILES['poster_esdeveniment']['name'];
        $tempName = $_FILES['poster_esdeveniment']['tmp_name'];
        $location = "resources/url_img/";
        move_uploaded_file($tempName, $location . $fileName);
        $imatge_poster = $fileName;
    } else {
        // AGAFA UNA DEFAULT
        $imatge_poster = "default.png";
    }

    $nom_esdeveniment = $_POST["nom_esdeveniment"];
    $descripcio_esdeveniment = $_POST["descripcio_esdeveniment"];
    $data_inici_esdeveniment = $_POST["data_inici_esdeveniment"];
    $data_inici_esdeveniment_correcta = str_replace('/', '-', $data_inici_esdeveniment);
    $data_final_esdeveniment = $_POST["data_final_esdeveniment"];
    $data_final_esdeveniment_correcta = str_replace('/', '-', $data_final_esdeveniment);
    $preu_esdeveniment = $_POST["preu_esdeveniment"];
    $preu_esdeveniment_correcte = intval($preu_esdeveniment);
    $nom_recinte_esdeveniment = $_POST["nom_recinte_esdeveniment"];
    $aforament_esdeveniment = $_POST["aforament_esdeveniment"];
    $aforament_esdeveniment_correcte = intval($aforament_esdeveniment);
    $poster_esdeveniment = $imatge_poster;
    $event = new Event();
    $event->insertEsdeveniment($nom_esdeveniment, $descripcio_esdeveniment, $data_inici_esdeveniment_correcta, $data_final_esdeveniment_correcta, $preu_esdeveniment_correcte, $aforament_esdeveniment_correcte, $poster_esdeveniment, 2);
    header("Location: ../esdeveniments.php");
}

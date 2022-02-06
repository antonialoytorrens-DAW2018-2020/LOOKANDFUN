<?php
// INCLUDE DATABASE AND OBJECT

include_once 'objects/event.php';

$requiredFields = ["nom_esdeveniment", "descripcio_esdeveniment", "data_inici_esdeveniment", "data_final_esdeveniment", "preu_esdeveniment", "codi_recinte_esdeveniment", "aforament_esdeveniment", "ocupacio_esdeveniment", "id_esdeveniment"];
$allElementsSet = true;
foreach ($requiredFields as $requiredField) {
    if (!isset($_POST[$requiredField])) {
        $allElementsSet = false;
        break;
    }
}
if ($allElementsSet) {

    if($_FILES['poster_esdeveniment']['size'] != 0) {
    // Move tmp file a api/resources/url_img
    $fileName = $_FILES['poster_esdeveniment']['name'];
    $tempName = $_FILES['poster_esdeveniment']['tmp_name'];
    $location = "resources/url_img/";
    move_uploaded_file($tempName, $location.$fileName);
    $imatge_poster = $fileName;
    } else {
        // Si no s'ha pujat cap fitxer, es manté la que ja es tenia
        $imatge_poster = $_POST["default_path_image"];
    }

    $id_esdeveniment = $_POST["id_esdeveniment"];
    $nom_esdeveniment = $_POST["nom_esdeveniment"];
    $descripcio_esdeveniment = $_POST["descripcio_esdeveniment"];
    $data_inici_esdeveniment = $_POST["data_inici_esdeveniment"];
    $data_final_esdeveniment = $_POST["data_final_esdeveniment"];
    $preu_esdeveniment = $_POST["preu_esdeveniment"];
    $codi_recinte_esdeveniment = $_POST["codi_recinte_esdeveniment"];
    $aforament_esdeveniment = $_POST["aforament_esdeveniment"];
    $ocupacio_esdeveniment = $_POST["ocupacio_esdeveniment"];
    $poster_esdeveniment = $imatge_poster;
    $event = new Event();
    $event->updateEsdeveniment($id_esdeveniment, $nom_esdeveniment, $descripcio_esdeveniment, $data_inici_esdeveniment, $data_final_esdeveniment, $preu_esdeveniment, $codi_recinte_esdeveniment, $aforament_esdeveniment, $ocupacio_esdeveniment, $poster_esdeveniment);
    header("Location: ../esdeveniments.php");
}

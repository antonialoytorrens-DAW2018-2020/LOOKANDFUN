<?php
// INCLUDE DATABASE AND OBJECT

include_once 'objects/entrada.php';
include_once 'objects/event.php';

$requiredFields = ["id_esdeveniment", "descompte_entrada"];
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

    $id_esdeveniment = $_POST["id_esdeveniment"];
    $descompte_entrada = $_POST["descompte_entrada"];
    $entrada = new Entrada();
    $entrada->insertEntrada($id_esdeveniment, $descompte_entrada);
    header("Location: ../entrades.php");
}

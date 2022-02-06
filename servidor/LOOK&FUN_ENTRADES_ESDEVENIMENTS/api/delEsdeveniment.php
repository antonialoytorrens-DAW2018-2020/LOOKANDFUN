<?php
// INCLUDE DATABASE AND OBJECT

include_once 'objects/event.php';

if (isset($_POST["id_esdeveniment"])) {
    $id_esdeveniment = $_POST["id_esdeveniment"];
    $event = new Event();
    $event->deleteEsdeveniment($id_esdeveniment);
    header("Location: ../esdeveniments.php");
}

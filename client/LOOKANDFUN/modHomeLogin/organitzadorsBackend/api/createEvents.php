<?php
// required headers
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: multipart/form-data; boundary='&'"); //!!!OJO PER AQUI DALT (former application/json)
//header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//Me dona errors sense passar JSON, ask Tomeu i guess :(
// include database and object files
include_once 'objects/event.php';
require_once("config/db.const.php");

// initialize object
$event = new Event();
//$data = json_decode(file_get_contents("php://input")); //Just go through $POST and $FILE

//$var_str = var_export($data, true);
$var_str = var_export($_FILES, true);
$var = "<?php\n\n\$text = $var_str;\n\n?>";
file_put_contents('filename.php', $var); //Personal checker per datos

/*
// make sure data is not empty
if(
    !empty($data->inputtextNom) &&
    !empty($data->inputtextareaDes) &&
    !empty($data->inputdateDat) &&
    !empty($data->inputtextAfo) &&
    !empty($data->radioTipusEvent) &&
    !empty($data->selectCatId) //$$ inputfileIMG
){

    // set product property values
    $event->nom_event = $data->inputtextNom;
    $event->fk_id_cat = $data->selectCatId;
    $event->fk_id_org = 1;
    $event->desc_event = $data->inputtextareaDes;
    $event->data_event = $data->inputdateDat;
    $event->tipus_event = false;*/
//GO POST STYLE
    //make sure important data(the not null) is not empty
    if(
        !empty($_POST['inputtextNom']) &&
        !empty($_POST['inputtextareaDes']) &&
        !empty($_POST['selectCatId']) &&
        !empty($_FILES['inputfilePos']) &&
        !empty($_POST['inputdateDat']) &&
        !empty($_POST['radioTipusEvent'])
    ){
    //Set data
    $event->nom_event = $_POST['inputtextNom'];
    $event->desc_event = $_POST['inputtextareaDes'];
    $event->fk_id_cat = $_POST['selectCatId'];
    if($_POST['radioTipusEvent']='Privat') {
        $event->tipus_event = $_POST['radioTipusEvent'];
    } else $event->tipus_event = false;

    if(isset($_POST['inputtextAfo'])) {
        $event->aforo = $_POST['inputtextAfo'];
    }else $event->aforo = null;


    $event->data_event = $_POST['inputdateDat'];

    //obligat
    $event->fk_id_org = 1; //Per defecte enviarem l'organitzador 1
    //Validacio arxiu jpg
        //Filtra errors (if)
            $allowedTypes = array('image/jpg','image/png','image/jpeg');
            $fileType = $_FILES['inputfilePos']['type'];

            if (!in_array($fileType,$allowedTypes) || $_FILES['inputfilePos']['error']!=0) {
            //ergo hi ha un error
            //do something
            } else {
            //Obtenir el nom (NO INTERESSA)
            //$ext = substr($_FILES['pdf']['type'], strpos($_FILES['pdf']['type'], "/") + 1);
            //$nomFitxer = $vsname.$vcode.".".$ext;
            //Copiar l'arxiu amb el nom corresponent
            /*$nomFitxer = 'hola.jpg';
            move_uploaded_file($_FILES['inputfilePos']['tmp_name'], LAF_URL_IMG.$nomFitxer);
            //$dir = 'C:\\users\\nylonx\\Documents\\';
            //$arrFitxers = scandir($dir);
            //print_r($arrFitxers);
            // set response code - 201 created
                $newPath = 'resources\\url_img\\hola.jpg';
            $event->source_poster_event = $newPath;*/
            $event->poster_ext = $_FILES['inputfilePos']['name'];
            $event->source_poster_event = $_FILES['inputfilePos']['tmp_name'];

                //http_response_code(201);

                // tell the user
                //echo json_encode(array("message" => "Product was created."));
            }
        // create the product
        if($event->create()){

            // set response code - 201 created
            http_response_code(201);

            // tell the user
            echo json_encode(array("message" => "Product was created."));
        }
        // if unable to create the product, tell the user
        else{

            // set response code - 503 service unavailable
            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to create product."));
        }
    }
    // tell the user data is incomplete
    else{
        // set response code - 400 bad request
        http_response_code(400);
        // tell the user
        echo json_encode(array("message" => "Unable to create product. Data is incomplete.".print_r($_POST).print_r($_FILES)));
    }
?>

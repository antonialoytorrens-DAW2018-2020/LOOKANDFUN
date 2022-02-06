<?php
$base = __DIR__;
require_once("$base/lib/resposta.class.php");
require_once("$base/model/esdeveniment.class.php");

$esdeveniment = new Esdeveniment();

$esdeveniment->insert(array("NOM"=>"Exemple" ,
                      "DESCRIPCIO"=>"sample",
                      "DATA_INICI"=>2018-01-01,
                      "DATA_FI"=>2019-01-01,
                      "PREU"=>10,
                      "AFORAMENT"=>200,
                      "FK_CODI_RECINTE"=>1));

$esdeveniment->update(array("PK_ID_ESDEVENIMENT"=>1,
                        "NOM"=>"ExampleModificat",
                        "DESCRIPCIO"=>"sample",
                        "DATA_INICI"=>2018-02-02,
                        "DATA_FI"=>2019-02-02,
                        "PREU"=>22,
                        "AFORAMENT"=>222,
                        "FK_CODI_RECINTE"=>1));

$esdeveniment->delete(1);
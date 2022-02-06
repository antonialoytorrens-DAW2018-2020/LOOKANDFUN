<?php
Use App\Model\Esdeveniment;
/*$app->group('/hola/', function () {
 $this->get('cat-cat', function ($req, $res, $args) {
 return $res->getBody() ->write('Hola mon!!');
 });
 $this->get('en-US', function ($req, $res, $args) {
 return $res->getBody()->write('Hello world!!');
 });
});*/

$app->group('/event/', function () {
 //Select All   GET      /event/
 $this->get('', function ($req, $res, $args) {
 	$obj = new Esdeveniment;
 	return $res
 		->withHeader('Content-type', 'application/json')
 		->getBody()
 		->write(
 			json_encode(
 				$obj->getAll()
 			)
 		);
 	});
    //Insert One    POST    /event/
    $this->post('', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $obj = new Esdeveniment();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->insert($atributs)
                )
            );
    });
    //Select One   GET      /event/1
    $this->get('{id}', function ($req, $res, $args) {
        $obj = new Esdeveniment();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->get($args["id"])
                )
            );
    });
    //update One    PUT     /event/1
    $this->put('{id}', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $atributs["id"]=$args["id"]; // Afegim id a la llista d'atributs
        $obj = new Esdeveniment();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->update($atributs)
                )
            );
    });
    //delete One        DELETE      /event/1
    $this->delete('{id}', function ($req, $res, $args) {
        $obj = new Esdeveniment();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->delete($args["id"])
                )
            );
    });

});
?>
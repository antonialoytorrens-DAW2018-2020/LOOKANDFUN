<?php
Use App\Model\recinte;

$app->group('/recinte/', function () {
    //Select All   GET      /recinte/
    $this->get('', function ($req, $res, $args) {
        $obj = new Recinte;
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->getAll()
                )
            );
    });
    //Insert One    POST    /recinte/
    $this->post('', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $obj = new Recinte();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->insert($atributs)
                )
            );
    });
    //Select One   GET      /recinte/1
    $this->get('{id}', function ($req, $res, $args) {
        $obj = new Recinte();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->get($args["id"])
                )
            );
    });
    //update One    PUT     /recinte/1
    $this->put('{id}', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $atributs["id"]=$args["id"]; // Afegim id a la llista d'atributs
        $obj = new Recinte();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->update($atributs)
                )
            );
    });
    //delete One        DELETE      /recinte/1
    $this->delete('{id}', function ($req, $res, $args) {
        $obj = new Recinte();
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
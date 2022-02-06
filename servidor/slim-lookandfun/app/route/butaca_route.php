<?php
Use App\Model\butaca;

$app->group('/butaca/', function () {
    //Select All   GET      /butaca/
    $this->get('', function ($req, $res, $args) {
        $obj = new Butaca;
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->getAll()
                )
            );
    });
    //Select All from 1 Recinte   GET      /butaca/2
    $this->get('{id}', function ($req, $res, $args) {
        $obj = new Butaca();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->getByRecinte($args["id"])
                )
            );
    });

    //Insert All   POST    /butaca/
    $this->post('', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $obj = new Butaca();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->superInsert($atributs)
                )
            );
    });

    //Delete 1 particular butaca /butaca/2 i per "delete" PK_FILA_BUTACA=? i PK_NUMERO_BUTACA=?
    $this->delete('{id}', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $atributs["id"]=$args["id"]; // Afegim id a la llista d'atributs
        $obj = new Butaca();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->delete($atributs)
                )
            );
    });
});

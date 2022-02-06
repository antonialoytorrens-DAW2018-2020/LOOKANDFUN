<?php

use App\Model\Persona;

$app->group('/persona/', function () {
    $this->get('', function ($req, $res, $args) {
        $obj = new Persona();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->getAll()
                )
            );
    });

    $this->get('{id}', function ($req, $res, $args) {
        $obj = new Persona();
        return $res
            ->withHeader('Content-type','application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->get($args["id"])
                )
            );
    });

    $this->get('filtra/{where}[/{order}[/{offset}[/{count}]]]', function ($req, $res, $args) {
        $obj = new Persona();
        $where=$args["where"];
        $orderby = (isset($args["orderby"]) ? $args["orderby"] : "");
        $offset = (isset($args["offset"]) ? $args["offset"] : "");
        $count = (isset($args["count"]) ? $args["count"] : "");
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->filtra($where,$orderby,$offset,$count)
                )
            );
    });

    $this->post('', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $obj = new Persona();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->insert($atributs)
                )
            );
    });

    $this->put('{id}', function ($req, $res, $args) {
        $atributs=$req->getParsedBody(); //llista atributs del client
        $atributs["id"]=$args["id"]; // Afegim id a la llista d'atributs
        $obj = new Persona();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->update($atributs)
                )
            );
    });

    $this->delete('{id}', function ($req, $res, $args) {
        $obj = new Persona();
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

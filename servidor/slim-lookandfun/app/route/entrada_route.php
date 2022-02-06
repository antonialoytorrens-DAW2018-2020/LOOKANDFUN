<?php

use App\Model\Entrada;

$app->group('/entrada/', function () {
    $this->get('', function ($req, $res, $args) {
        $obj = new Entrada();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->getAll()
                )
            );
    });
    $this->get('{entrada}', function ($req, $res, $args) {
        $obj = new Entrada();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->get($args["entrada"])
                )
            );
    });

    $this->put('{entrada}/{descompte}', function ($req, $res, $args) {
        $obj = new Entrada();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->insert($args["entrada"], $args["descompte"])
                )
            );
    });

    $this->delete('{esdeveniment}/{entrada}', function ($req, $res, $args) {
        $obj = new Entrada();
        return $res
            ->withHeader('Content-type', 'application/json')
            ->getBody()
            ->write(
                json_encode(
                    $obj->delete($args["esdeveniment"], $args["entrada"])
                )
            );
    });
});

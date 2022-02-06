<?php

use App\Model\TipusEsdeveniment;

$app->group('/tipusEsdeveniment/', function () {
    $this->get('', function ($req, $res, $args) {
        $obj = new TipusEsdeveniment();
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
        $obj = new TipusEsdeveniment();
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
        $obj = new TipusEsdeveniment();
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
});



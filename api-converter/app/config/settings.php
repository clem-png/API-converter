<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

return[
    'format' => function (ContainerInterface $c) {
        //$conf = file_get_contents('conf/apiConverter.json');
        //$confJSON = json_decode($conf);
        //$confJSON->format;
        return ["txt","xlsx"];
    }
];
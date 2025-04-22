<?php

use apiConverter\application\actions\PostConvertAction;
use apiConverter\core\services\converter\ConverterService;
use apiConverter\core\services\converter\ConverterServiceInterface;
use Psr\Container\ContainerInterface;

return [

    # INFRA

    # SERVICE

    ConverterServiceInterface::class => function (ContainerInterface $container){
        return new ConverterService();
    },

    # ACTION

    PostConvertAction::class => function (ContainerInterface $container){
        return new PostConvertAction($container->get(ConverterServiceInterface::class), $container->get('format'));
    }

];
<?php
declare(strict_types=1);

use apiConverter\application\actions\PostConvertAction;
use Slim\App;

return function(App $app): App {


    $app->post('/converter',PostConvertAction::class);

    return $app;
};
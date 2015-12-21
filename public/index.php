<?php
require '../vendor/autoload.php';

$container = new \Slim\Container(require '../config/app.config');

$app = new \Collective\Collective($container);

foreach ($container['app-middleware'] as $mw) {
    $app->add($mw);
}

foreach ($container['routes']['get'] as $pattern => $callable) {
    $app->get($pattern, $callable);
}


$app->run();

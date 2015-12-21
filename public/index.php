<?php
require '../vendor/autoload.php';

$container = new \Slim\Container(require '../config/app.config');

$app = new \Collective\Collective($container);

foreach ($container['app-middleware'] as $mw) {
    $app->add($mw);
}

foreach ($container['routes']['get'] as $pattern => $info) {

    $route = $app->get($pattern, $info['callable']);

    if (isset($info['mw']) && count($info['mw']) > 1) {
        foreach ($info['mw'] as $mw) {
            $route->add($mw);
        }
    }

    if (!empty($info['name'])) {
        $route->setName($info['name']);
    }
}


$app->run();

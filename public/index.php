<?php
require '../vendor/autoload.php';

$container = new \Slim\Container(require '../config/app.config');

$app = new \Collective\Collective($container);

$app->applyMiddleware();

$app->applyRoutes();

$app->run();

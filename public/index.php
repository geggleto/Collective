<?php
require '../vendor/autoload.php';

use Collective\Actions\HelloWorldAction;
use Collective\Middleware\LoggerMiddleware;

$container = new \Slim\Container(require '../config/app.config');

$app = new \Collective\Collective($container);

$app->add(LoggerMiddleware::class);

$app->get('/', HelloWorldAction::class);

$app->run();

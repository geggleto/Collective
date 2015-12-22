<?php
// application.php

require 'vendor/autoload.php';

use Collective\Commands\CreateActionCommand;
use Collective\Commands\CreateMiddlewareCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new CreateActionCommand());
$application->add(new CreateMiddlewareCommand());
$application->run();
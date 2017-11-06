<?php
/** @var \Exedra\Web\Application $app */
$app = require_once __DIR__ . '/app.php';

$console = new \Symfony\Component\Console\Application();

$console->add(new \Exedron\Routeller\Console\Commands\RouteListCommand($app, $app->map));

$console->run();
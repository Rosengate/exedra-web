<?php
// require_once "../testexedra/vendor/rosengate/exedra/Exedra/Exedra.php";
require_once "vendor/autoload.php";
ini_set('display_errors', 'on');
error_reporting(E_ALL);

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("App", $exedra->loader->load('app.php'));
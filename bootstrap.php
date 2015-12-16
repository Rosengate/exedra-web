<?php
// require_once "../testexedra/vendor/rosengate/exedra/Exedra/Exedra.php";
// require_once __DIR__."/../exedra/Exedra/Exedra.php";
require_once 'vendor/autoload.php';
ini_set('display_errors', 'on');
error_reporting(E_ALL);

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("app", $exedra->loader->load('app.php'));

return $app;
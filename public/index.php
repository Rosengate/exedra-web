<?php
require_once '../bootstrap.php';

$app = $exedra->get('App');

if($app->config->get('env') == 'local')
	$exedra->httpRequest->resolveUri();

$exedra->dispatch();
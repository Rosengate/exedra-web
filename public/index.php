<?php
require_once '../bootstrap.php';

$app = $exedra->get('app');

if($app->config->get('env') == 'local')
	$exedra->httpRequest->resolveUri();

$exedra->dispatch();
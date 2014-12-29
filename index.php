<?php
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("app", function($app)
{
	$app->setFailRoute('doc.error');

	// general config.
	$app->config->set([
		'url.base'=> 'http://localhost/side/exedra-web',
		'url.asset'=> 'http://localhost/side/exedra-web/assets'
		]);

	$app->map->addRoute(array(
		"main"=>['execute'=> function($exe){
			// $exe->url->setBase('http://localhost/side/exedra-web');
			// $exe->url->setAsset('http://localhost/side/exedra-web/assets');

			$docsurl = $exe->url->create('doc.default', ['folder'=> 'application', 'file'=> 'boot']);
			return "Building exedra homebase.<br>Status : on <a href='$docsurl'>documentation</a> level.";}],
		"doc"=> ['uri'=>'documentation', 'subapp'=>'docs', 'subroute'=>[
			'error'=>['uri'=>false, 'execute'=>function($exe)
			{
				// re-route to error page.
				return $exe->execute('default', ['folder'=>'error', 'file'=> '404', 'message'=> $exe->param('exception')->getMessage()]);
			}],
			'default'=>['uri'=> '[:folder]/[:file]', 'execute'=> function($exe) {
					// $exe->url->setBase('http://localhost/side/exedra-web');
					// $exe->url->setAsset('http://localhost/side/exedra-web/assets');

					// set default data for view builder
					$exe->view->setDefaultData('exe', $exe);

					// layout.
					$layout = $exe->view->create("template/default");

					// just create a view. no need a controller.
					$view = $exe->param('folder')."/".$exe->param('file');
					$layout->set('menu', json_decode($exe->app->loader->getContent('model:docs.menu.json'), true));
					$layout->set('content', $exe->view->create($view));
					return $layout->render();
				}]
			]]
		));
});

$exedra->dispatch();


?>
<?php
// require_once "../testexedra/vendor/rosengate/exedra/Exedra/Exedra.php";
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("app", function($app)
{
	$app->setFailRoute('doc.error');

	// general config.
	$conf['dev'] = array(
		'url.base'=> 'http://localhost/side/exedra-web',
		'url.asset'=> 'http://localhost/side/exedra-web/assets',
		);

	$conf['pro'] = array(
		'url.base'=> 'http://exedra.rosengate.com',
		'url.asset'=> 'http://exedra.rosengate.com/assets'
		);

	$app->config->set($conf[file_get_contents('../env')]);

	$app->map->addRoute(array(
		"main"=>['subapp'=>'web','execute'=> function($exe){
			$exe->view->setDefaultData('exe', $exe);

			$data['docsUrl'] = $exe->url->create('doc');
			
			return $exe->view->create('layout/default', $data)->render();
		}],
		"doc"=> ['uri'=>'docs', 'subapp'=>'docs',
			'execute'=> function($exe)
				{
					// forward to first topic.
					return $exe->execute('@doc.default', ['view'=> ['application', 'boot']]);
				},
			'subroute'=>[
				'error'=>['uri'=>false, 'execute'=>function($exe)
				{
					// re-route to error page.
					return $exe->execute('default', ['view'=>['error',404], 'message'=> $exe->param('exception')->getMessage()]);
				}],
				'default'=>['uri'=> '[**:view]', 'execute'=> function($exe) {
						// set default data for view builder
						$exe->view->setDefaultData('exe', $exe);

						// layout.
						$layout = $exe->view->create("template/default");

						// just create a view. no need a controller.
						// $view = $exe->param('folder')."/".$exe->param('file');
						$view = implode("/", $exe->param('view'));
						$layout->set('menu', json_decode($exe->app->loader->getContent(array('structure'=> 'model','path'=> 'docs.menu.json')), true));
						$layout->set('content', $exe->view->create($view));
						return $layout->render();
					}]
				]]
		));
});

$exedra->dispatch();


?>
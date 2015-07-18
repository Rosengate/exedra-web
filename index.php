<?php
// require_once "../testexedra/vendor/rosengate/exedra/Exedra/Exedra.php";
require_once "vendor/autoload.php";
ini_set('display_errors', 'on');
error_reporting(E_ALL);

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("App", function($app)
{
	$app->setFailRoute('doc.error');

	$env = trim(file_get_contents('../env'));

	// general config.
	$conf['dev'] = array(
		'app.url'=> 'http://localhost/side/exedra-web',
		'asset.url'=> 'http://localhost/side/exedra-web/assets',
		);

	$conf['pro'] = array(
		'app.url'=> 'http://exedra.rosengate.com',
		'asset.url'=> 'http://exedra.rosengate.com/assets'
		);

	$app->config->set($conf[$env]);

	if($app->loader->has('config/env_config.php'))
		$app->config->set($app->loader->load('config/env_config.php'));

	$app->registry->addMiddleware(function($exe)
	{
		$exe->setFailRoute('404');
		$exe->response->header('Route', $exe->route->getAbsoluteName());

		return $exe->next($exe);
	});

	$app->map->addRoutes(array(
		"main"=>['module'=>'web','execute'=> function($exe){
			$exe->view->setDefaultData('exe', $exe);

			$data['docsUrl'] = $exe->url->create('doc');
			
			return $exe->view->create('layout/default', $data)->render();
		}],
		"doc"=> ['uri'=>'docs', 'module'=>'docs',
			'execute'=> function($exe)
				{
					// forward to first topic.
					return $exe->execute('@doc.default', ['view'=> ['application', 'boot']]);
				},
			'subroutes'=>[
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

						// only return view without template, if request is ajax.
						if($exe->request->isAjax())
						{
							return $exe->view->create($view)->render();
						}
						else
						{
							$layout->set('menu', json_decode($exe->app->loader->getContent(array('structure'=> 'model','path'=> 'docs.menu.json')), true));
							$layout->set('content', $exe->view->create($view));
							return $layout->render();
						}
					}]
				]]
		));
});

$exedra->dispatch();


?>
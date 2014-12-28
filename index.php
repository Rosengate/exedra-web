<?php
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);

$app = $exedra->build("app", function($app)
{
	$app->setFailRoute('doc.error');

	$app->map->addRoute(array(
		"doc"=> ['uri'=>'documentation', 'subapp'=>'docs', 'subroute'=>[
			'error'=>['uri'=>false, 'execute'=>function($exe)
			{
				// re-route to error page.
				return $exe->execute('default', ['folder'=>'error', 'file'=> '404', 'message'=> $exe->param('exception')->getMessage()]);
			}],
			'default'=>['uri'=> '[:folder]/[:file]', 'execute'=> function($exe){
					$exe->url->setBase('http://localhost/side/exedra-web');
					$exe->url->setAsset('http://localhost/side/exedra-web/assets');

					// set default data for view builder
					$exe->view->setDefaultData('exe', $exe);

					// layout.
					$layout = $exe->view->create("template/default");

					// just create a view. no need a controller.
					$view = $exe->param('folder')."/".$exe->param('file');

					$layout->set('menu', array(
							'Application Lifecycle'=> array(
								'application/boot'=> 'Booting Up',
								'application/routing'=>'Routing',
								'application/execution'=> 'Execution',
								'application/middleware'=> 'Middleware',
								'application/structure'=> 'Structure'
								),
							'M.V.C Builder'=> array(
								'builder/controller'=> 'Controller',
								'builder/view'=> 'View',
								'builder/model'=> 'Model'
								),
							'Components'=> array(
							'component/url'=> 'URL',
							'component/session'=> 'Session',
							'component/validator'=> 'validator',
							'component/redirection'=> 'Redirection',
							'component/form'=> 'Form'
								)
						));
					$layout->set('content', $exe->view->create($view));
					return $layout->render();
				}]
			]]
		));
});

$exedra->dispatch();


?>
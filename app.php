<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);

$app->setFailRoute('doc.error');

$app->config->set(array(
	'env' => 'prod',
	'asset.url'=> '/assets'
	));

// now most config is configured for production.
// so, for your own environment, just set up below file, and return the same array of config.
// file : app/config/env_config.php
if($app->path->has('config/env_config.php'))
	$app->config->set($app->path->load('config/env_config.php'));

$app->map->middleware(function($exe)
{
	$exe->asset->setBasePath('public/assets');

	$exe->response->header('Route', $exe->route->getAbsoluteName());

	return $exe->next($exe);
});

$app->map->addRoutes(array(
	"main"=>['module' => 'Web', 'execute'=> function($exe){
		$exe->view->setDefaultData(array('exe' => $exe, 'url' => $exe->url));

		$data['docsUrl'] = $exe->url->create('doc');

		return $exe->view->create('layout/default_new', $data)->render();
	}],
	"doc"=> ['uri'=>'docs', 'module' => 'Docs',
		'middleware' => function($exe)
		{
			$exe->url->register('docs', function($path)
			{
				return $this->create('@doc.default', array('view' => $path));
			});

			return $exe->next($exe);
		},
		'execute'=> function($exe)
			{
				// forward to first topic.
				return $exe->execute('@doc.default', ['view'=> 'introduction/about']);
			},
		'subroutes'=>[
			'error'=>['uri'=>false, 'execute'=>function($exe)
			{
				// re-route to error page.
				return $exe->forward('default', ['view' => 'error/404', 'message' => $exe->param('exception')->getMessage()]);
				// return $exe->execute('default', ['view'=>'error/404', 'message'=> $exe->param('exception')->getMessage()]);
			}],
			'default'=>['uri'=> '[*:view]', 'execute'=> function($exe) {
					// set default data for view builder
					$exe->view->setDefaultData(array('exe' => $exe, 'url' => $exe->url));

					// layout.
					$layout = $exe->view->create("template/default");

					// just create a view. no need a controller.
					$view = $exe->param('view');

					// only return view without template, if request is ajax.
					if($exe->request->isAjax())
					{
						return $exe->view->create($view)->render();
					}
					else
					{
						$layout->set('menu', json_decode($exe->path['app']->getContents('Model/docs.menu.json'), true));

						$layout->set('content', $exe->view->create($view));
						
						return $layout->render();
					}
				}]
			]]
	));

return $app;
?>
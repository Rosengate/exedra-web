<?php
return function($app)
{
	$app->setFailRoute('doc.error');

	$app->config->set(array(
		'env' => 'prod',
		'app.url' => 'http://exedra.rosengate.com',
		'asset.url'=> 'http://exedra.rosengate.com/assets'
		));

	// now most config is configured for production.
	// so, for your own environment, just set up below file, and return the same array of config.
	// file : app/config/env_config.php
	if($app->loader->has('config/env_config.php'))
		$app->config->set($app->loader->load('config/env_config.php'));

	$app->registry->addMiddleware(function($exe)
	{
		// $exe->asset->setBasePath('public/assets');
		$exe->response->header('Route', $exe->route->getAbsoluteName());

		return $exe->next($exe);
	});

	$app->map->addRoutes(array(
		'git-pull' => ['path' => 'git-pull', 'execute' => function($exe)
		{
			if(!($signature = $exe->request->getHeader('X-Hub-Signature')))
				return 'Bad request';

			// Split signature into algorithm and hash
			list($algo, $hash) = explode('=', $signature, 2);

			$payload = file_get_contents('php://input');

			$payloadHash = hash_hmac($algo, $payload, 'gitisthebest');

			// because nobody should know what does the hash mean.
			if($hash != $payloadHash)
				return 'Sorry, no proper response for you.';

			// pull from latest
			chdir(__DIR__);
			exec('git remote update');
			exec('git reset --hard origin/master');
		}],
		"main"=>['module'=>'web','execute'=> function($exe){
			$exe->view->setDefaultData(array('exe' => $exe, 'url' => $exe->url));

			$data['docsUrl'] = $exe->url->create('doc');

			return $exe->view->create('layout/default_new', $data)->render();
		}],
		"doc"=> ['path'=>'docs', 'module'=>'docs',
			'execute'=> function($exe)
				{
					// forward to first topic.
					return $exe->execute('@doc.default', ['view'=> 'application/introduction']);
				},
			'subroutes'=>[
				'error'=>['path'=> false, 'execute'=>function($exe)
				{
					// re-route to error page.
					return $exe->execute('default', ['view'=>'error/404', 'message'=> $exe->param('exception')->getMessage()]);
				}],
				'default'=>['path'=> '[*:view]', 'execute'=> function($exe) {
						// set default data for view builder
						$exe->view->setDefaultData(array('exe' => $exe, 'url' => $exe->url));

						// layout.
						$layout = $exe->view->create("template/default");

						// just create a view. no need a controller.
						// $view = $exe->param('folder')."/".$exe->param('file');
						// $view = implode("/", $exe->param('view'));
						$view = $exe->param('view');

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
}
?>
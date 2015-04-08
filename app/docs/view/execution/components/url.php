<h1>Url <span>\Exedra\Application\Builder\Url</span></h1>
<p>In exedra, we do not purely write a url of your specific route, except through a builder, that was based on current execution context. Url is built with route reading capability, since exedra is an heavily route oriented application, you need to specify route name and it's URI named parameter.</p>
<h2>1. Create a URL</h2>
<p>Specify route name, and parameters required.</p>
<p>p/s : consider below routing for the further subtopic.</p>
<pre><code>
$app->map->addRoute(array(
	'public'=> ['uri'=>'', 'subroute'=> array(
		'user'=> ['uri'=>'user', 'subroute'=>array(
			'index'=> ['uri'=> '', 'execute'=> function()
			{
				// public.user.index
			}],
			'profile'=> ['uri'=> '[:username]', function()
			{
				// public.user.profile
			}]
		)],
		'page'=> ['uri'=>'page', 'execute'=>function()
		{
			// public.page
		}]
	)]
));
</code></pre>
<p>Within route public.user.index : </p>
<h3>1.1 Relative Route</h3>
<pre><code>
// create public.user.profile url.
$url = $exe->url->create('profile', ['username'=> 'eimihar']);
</code></pre>
<pre><code>
// create public.page (will return an error, unable to create url)
$url = $exe->url->create('page');
</code></pre>
<p>The second example will throw an error, due to inablity to find route named 'page' under the prefix 'public.user'.</p>
<h3>2. Absolute Route</h3>
<p>To specify the absolute route, do this (while following the same scenario as above):</p>
<pre><code>
// create url for route public.page
$url = $exe->url->create('@public.page');
</code></pre>
<p>Above pattern will not care on what route you're currently on.</p>
<h2>2. Url with route prefixing</h2>
<p>Like we've been mentioned earlier, route prefixing would basically affect on how route would be read on creating a URL. Every route mentioned in the first parameter of the URL would be prefixed with the configured route prefix. Consider below routing : </p>
<p>p/s : It's best to set a route prefix in a middleware.</p>
<pre><code>
$app->map->addRoute(array(
	'public'=> ['uri'=>'','middleware'=>function($exe){

		// prefix all the nested route with 'public'
		$exe->setRoutePrefix('public');
		return $exe->next($exe);
	}, 
	'subroute'=> array(
		'user'=> ['uri'=>'user', 'subroute'=>array(
			'index'=> ['uri'=> '', 'execute'=> function()
			{
				// public.user.index
			}],
			'profile'=> ['uri'=> '[:username]', function()
			{
				// public.user.profile
			}]
		)], // end of public.user
		'page'=> ['uri'=>'page', 'execute'=>function()
		{
			// public.page
		}]
	)]
));
</code></pre>
<p>So, later, all the relative route writing would be prefixed with the configured one, instead of it's parent.</p>
<p>Inside route <strong>public.user.index</strong></p>
<pre><code>
// get url for public.user.profile
$url = $exe->url->create('user.profile', ['username'=>'eimihar']);

// get url for public.page
$url = $exe->url->create('page');
</code></pre>
<h2>4. Base And Asset Url</h2>
<p>You may configure a base url with on the url builder itself ($exe->url).</p>
<pre><code>
$exe->url->setBase('http://localhost/myproject');
$exe->url->setAsset('http://localhost/myproject/assets');
</code></pre>
<p>Or through application configuration : </p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);
$myapp = $exedra->build("app", function($app)
{
	$app->config->set([
		'baseUrl'=> 'http://localhost/myproject',
		'assetUrl'=> 'http://localhost/myproject/assets'
	]);
});

$exedra->dispatch();
</code></pre>
<p>This configuration will be applied across your executed application.</p>
<p>p/s : you may later retrieve any configured parameter through $app instance. Refer <a href='<?php echo $exe->url->create('@doc.default', array('view' => array('application', 'components', 'config')));?>'>config</a> for more details.</p>
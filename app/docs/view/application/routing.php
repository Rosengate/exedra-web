<h1>Routing <span>\Exedra\Application\Map\.</span></h1>
<p>The main component of exedra, that basically front-route every single request for your application based on your designed map of routes. Every route is unique, and identifable by name. They're reusable to the extend of re-creating a url for the route, or query a route even for your own use. In this page we'll focus on writing them.</p>
<p>If you're still on learning, please use the same index.php from the last topic.</p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);
$myapp = $exedra->build("app", function($app)
{
	// this will be the main place where our routing is written next.
});

$exedra->dispatch();
</code></pre>
<h2>1. Basic</h2>
<p>You may simply add route(s) using a convenient method on Map ($map) instance injected as a property to your Application instance ($app). This method basically uses struct (array), with the <b>key</b> as route name against the <b>parameter(s)</b> of the route.</p>
<pre><code>
$app->map->addRoutes(array(
	'myroute' => array(
		'method' => 'get',
		'uri' => 'hello/world',
		'execute' => function()
			{
				return 'hello-world.';
			}
		)
));
</code></pre>
<h2>2. Available Parameters</h2>
<p>List of available parameters. All of them are optional. Route matches are dictated by the given HTTP Request internally.</p>
<div style="padding:10px; background: white;">
<?php $parameters = array(
	'method' => array(
		'description' => 'An HTTP Method. It can be a single method, or multiple method or any. Not specifying will accept any method.',
		'value' => array('get, post, put or delete', 'or a combination delimited by \',\'', 'any')
		),
	'uri' => array(
		'description' => 'A string of URI for this route to be matched with Request URI taken from $_SERVER variable. ($_SERVER[\'REQUEST_URI\'])',
		'value' => array('String of matchable URI.', ' Or false boolean')
		),
	'ajax' => array(
		'description' => 'Boolean whether will only accept ajax request or not.',
		'value' => 'boolean of true or false'
		),
	'execute' => array(
		'description' => 'A todo command if route is matched, once found.',
		'value' => array('A \\Closure', 'Or an execution pattern')
		),
	'middleware' => array(
		'description' => 'Bind a middleware on this route. Any route or it\'s child matched will stack a middleware on execution time.',
		'value' => array('A \\Closure', 'Or pattern specifying the handler.')
		),
	'subroutes' => array(
		'description' => 'Add list of routes assigned under the current route.',
		'value' => array('Array of routes', 'Or path specifying the location of the sub-routes for lazy loading functionality.')
		),
	'module' => array(
		'description' => 'Name of a module. Anything that executed under this route and it\'s child will be assigned to this module. The controller or view looked by the execution pattern will be prefixed by a folder named by this given module name.',
		'value' => 'String of module name.'
		)
);?>
<table class='table'>
	<tr>
		<th>Parameters</th>
		<th>Description</th>
		<th>Value</th>
	</tr>
	<?php foreach($parameters as $param => $struct):?>
	<tr>
		<td><?php echo $param;?></td>
		<td><?php echo $struct['description'];?></td>
		<td>
			<?php if(is_array($struct['value'])):?>
				<?php foreach($struct['value'] as $value):?>
					<?php echo '- '.$value.'<br>';?>
				<?php endforeach;?>
			<?php else:?>
				<?php echo $struct['value'];?>
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
</div>
<h2>3. Usages</h2>
<h3>3.1. HTTP Request method</h3>
<p>On specifying or by any methods : </p>
<pre><code>
$app->map->addRoutes(array(
	'test'	=> ['method'=> 'any', 'uri'=>'test-uri', 'execute'=> function(){ }], //any method
	'test2' => ['method'=> 'get,post', 'uri'=>'test-uri2', 'execute'=> function(){ }], //only permit GET and POST
	'test3' => ['uri'=>'lasttest', 'execute'=> function(){ }] //not specifying will set permitted method to any methods.
));
</code></pre>
<h3>3.2. URI</h3>
<p>Mocking uri 'my/test' will execute route 'test', and 'my/test/uri' will execute the route 'test2'</p>
<pre><code>
$app->map->addRoutes(array(
	'test' 	=> ['uri'=> 'my/test', 'execute'=> function(){ }],
	'test2' => ['uri'=> 'my/test/uri', 'execute'=> function(){ }]
));
</code></pre>
<h3>3.3. Named Parameter</h3>
<p>For every successful route execution, the handler will be given an instance of <b>\Exedra\Application\Execution\Exec</b> through the first parameter.<br>
You may then retrieve the value of the named parameter through that instance.</p>
<pre><code>
$app->map->addRoutes(array(
	'myroute'=>['uri'=> 'books/[:author]/[:book-title]', 'execute'=> function($exe)
	{
		return 'my-name is'. $exe->param('author') .', and i have a books called '. $exe->param('book-title');
	}]
));
</code></pre>
<h3>3.4. Nested Routing</h3>
<p>Ah, the main dish of the exedra is finally here. Basically, exedra let you nest a route into another route, then nest a route into another route, infinitely. The idea is, to let you build a nestful and resource oriented URI design, and control the structure as per route node, through a bound middleware (covered later).</p>
<p>For example :</p>
<pre><code>
$app->map->addRoutes(array(
	'user'=> ['uri'=> 'user/[:username]', 'subroute'=> array(
		'profile'=> ['uri'=> '', 'execute'=> function($exe){ }],
		'book'=> ['uri'=> 'book', 'subroute'=> array(
			'index'=> ['uri'=> '', 'execute'=> function($exe){ }],
			'view'=> ['uri'=> '[:book-title]', 'execute'=> function($exe){ }]
		)] // end of user.book
	)] // end of user
));
</code></pre>
<p>1. Executing URI 'user/john-doe' will execute route <b>user.profile</b><br>
2. Executing URI 'user/john-doe/book' will execute route <b>user.book.index</b><br>
3. Executing URI 'user/john-doe/book/alcataraz' will execute route <b>user.book.view</b></p>

<h3>3.5. False URI</h3>
<p>Setting up false flag on uri, will deny an HTTP request entry into that route. This may be good, if you want the route to solely be used somewhere.</p>
<pre><code>
$app->map->addRoutes(array(
	'error'=> ['uri'=>false, 'execute'=> function(){ }]
));
</code></pre>
<h3>3.6. Module</h3>
<p>You may set sub-application as route parameter, using key '<b>module</b>'. This will affect builder like controller and view on the current and following route to use the folder based on sub-application value set.</p>
<pre><code>
$app->map->addRoutes(array(
	'admin'=> ['uri'=> 'dashboard', 'module'=> 'admin', 'subroute'=> array(
		'default'=> ['uri'=> '[:controller]/[**:action]']
	)]
));
</code></pre>

<h2>4. Re-Routing</h2>
<p>You may execute another route within a successful execution handler. Either through the use of application instance, or the exec instance.</p>
<pre><code>
$app->map->addRoutes(array(
	'general'=> ['uri'=> '', 'subroute'=> array(
		'error'=> 	['uri'=> '404', 'execute'=> function(){ return "on error page"}],
		'by-app'=>	['uri'=> 'by-app', 'execute'=> function($exe) use($app) { return $app->execute('general.error')}],
		'by-exe'=>	['uri'=> 'firstexe', 'execute'=> function($exe){ return $exe->execute('error')}],
		'by-exe2'=> ['uri'=> 'secondexe', 'execute'=> function($exe){ return $exe->execute('@general.error')}]
	)]
));
</code></pre>
<p><b>Behaviour :</b><br>
1. To use $app, you just need to 'use' the variable from the outer scope. Or, you may just simply retrieve it through $exe, like this :
<pre><code>
$app = $exe->app;
</code></pre>
2. By default, the $exe instance is relatively referred to the current route prefix. Route prefix can be set, else, it will use the current level route node. Such affected component(s) are like URL builder.<br>
3. To escape and use the absolute route by the $exe instance, just use '<b>@</b>' at the beginning of route.<br>
Example can be shown on route 'general.by-exe2'
</p>
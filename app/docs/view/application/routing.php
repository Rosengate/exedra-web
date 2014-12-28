<h1>Routing</h1>
<p>The main component of exedra, that basically front-route every single request for your application based on your designed map of routes.</p>
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
<h2>1. Request method</h2>
<p>On specifying or by any methods : </p>
<pre><code>
$app->map->addRoute(array(
	'test'	=> ['method'=> 'any', 'uri'=>'test-uri', 'execute'=> function(){ }], //any method
	'test2' => ['method'=> 'get,post', 'uri'=>'test-uri2', 'execute'=> function(){ }], //only permit GET and POST
	'test3' => ['uri'=>'lasttest', 'execute'=> function(){ }] //not specifying will set permitted method to any methods.
));
</code></pre>
<h2>2. URI</h2>
<p>Mocking uri 'my/test' will execute route 'test', and 'my/test/uri' will execute the route 'test2'</p>
<pre><code>
$app->map->addRoute(array(
	'test' 	=> ['uri'=> 'my/test', 'execute'=> function(){ }],
	'test2' => ['uri'=> 'my/test/uri', 'execute'=> function(){ }]
));
</code></pre>
<h2>3. Named Parameter</h2>
<p>For every successful route execution, the handler will be given an instance of <b>\Exedra\Application\Execution\Exec</b> through the first parameter.<br>
You may then retrieve the value of the named parameter through that.</p>
<pre><code>
$app->map->addRoute(array(
	'myroute'=>['uri'=> 'books/[:author]/[:book-title]', 'execute'=> function($exe)
	{
		return 'my-name is'. $exe->param('author') .', and i have a books called '. $exe->param('book-title');
	}]
));
</code></pre>
<h2>4. Nested Routing</h2>
<p>Ah, the main dish of the exedra is finally here. Basically, exedra let you nest a route into another route, then nest a route into another route, infinitely. The idea is, to let you build a nestful and resource oriented URI design, and control the structure as per route node, through a bound middleware (covered later).</p>
<p>For example :</p>
<pre><code>
$app->map->addRoute(array(
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
<h2>5. Re-Routing</h2>
<p>You may execute another route within a successful execution handler. Either through the use of application instance, or the exec instance.</p>
<pre><code>
$app->map->addRoute(array(
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
<h2>6. False URI</h2>
<p>Setting up false flag on uri, will deny an HTTP request entry into that route. This may be good, if you want the route to solely be used somewhere.</p>
<pre><code>
$app->map->addRoute(array(
	'error'=> ['uri'=>false, 'execute'=> function(){ }]
));
</code></pre>
<h2>7. Subapplication</h2>
<p>You may set sub-application as route parameter, using key '<b>subapp</b>'. This will affect builder like controller and view on the current and following route to use the folder based on sub-application value set.</p>
<pre><code>
$app->map->addRoute(array(
	'admin'=> ['uri'=> 'dashboard', 'subapp'=> 'admin', 'subroute'=> array(
		'default'=> ['uri'=> '[:controller]/[**:action]']
	)]
));
</code></pre>
<h1>Middleware <span>\Exedra\Application\Builder\Middleware</span></h1>
<p>Middleware is simply a layer(s) that surrounds your execution context. In Exedra, the concept of middleware no longer bound to handling request/response only, but anything including your domain logic. Hence, the only argument accepted is just <span class='label label-class'>\Exedra\Application\Execution\Exec</span> instance <span class='label label-variable'>$exe</span> which already contain the request and response for the context.</p>
<p>Middleware is stacked, and make no distinction whether it's global or route based, on execution layer.</p>
<h2>1. Adding a middleware</h2>
<h3>1.1 Global middleware</h3>
<p>The middleware added on application level will be stacked on every execution.</p>
<pre><code>
$app->middleware->add(function($exe)
{
	return $exe->next($exe);
});
</code></pre>
<p>The <span class='label label-variable'>$app->middleware</span> instance is a <span class='label label-class'>Middleware\Registry</span> class located in <span class='label label-dir'>\Exedra\Application\Middleware\</span> which handle global middleware registration and named lookup registry.</p>
<p>The <span class='label label-method'>next</span> method on <span class='label label-variable'>$exe</span> instance basically tell the application to continue to the next middleware until the actual execution, unless breaked.</p>
<h3>1.2 Route based middleware</h3>
<h4>Breaking the chain</h4>
<p>Example on route based middleware, using convenient routing.</p>
<pre><code>
$app->map->any('/dashboard')->setMiddleware(function($exe)
{
	// execute route with tag auth
	if(!$exe->session->has('user'))
		return $exe->execute('#auth');

	return $exe->next($exe);
});

$app->map->add(['GET', 'POST'], '/auth')->setTag('auth')->execute(function($exe)
{
	return $exe->view
		->create('auth')
		->render();
});
</code></pre>
<p>Example on default routing</p>
<pre><code>
$app->map->addRoutes(array(
	'api' => array(
		'path' => '/admin',
		'middleware' => ['api-auth', 'rateLimiter', 'load=admin.php'] // refer the topic 3. 
	)
));
</code></pre>
<p>The route <span class='label label-property'>middleware</span> property accept single, or array of middleware.</p>
<h2>2. Handler</h2>
<p>The <span class='label label-method'>add</span> method on <span class='label label-property'>$app->middleware</span> instance, or the route <span class='label label-property'>middleware</span> property accept variety of handler pattern.</p>
<h4>2.1. \Closure</h4>
<pre><code>
$app->middleware->add(function()
{

});
</code></pre>
<h4>2.2. Fully qualified class name</h4>
<pre><code>
$app->middleware->add(MyMiddlewares\Auth::class);
</code></pre>
<p>Will look for a class <span class='label label-class'>MyMiddlewares\Auth</span> with the following handle</p>
<pre><code>
&lt;?php
namespace MyMiddlewares;

class Auth
{
	public function handle($exe)
	{
		return $exe->next($exe);
	}
}
</code></pre>
<h4>2.3. String based loading pattern</h4>
<h5 style="font-size: 1.2em; margin-top: 20px;">class={className}</h5>
<p>Relative to Application namespace + Middleware</p>
<pre><code>
$app->map->any()->setMiddleware('class=Csrf');
</code></pre>
<p>Will look for class <span class='label label-class'>\App\Middleware\Csrf</span> on file <span class='label label-file'>App/Middleware/Csrf.php</span> with the following handle (similar like previous one).</p>
<pre><span class='code-tag label label-file'>App/Middleware/Csrf.php</span><code>
&lt;?php
namespace App\Middleware;

class Csrf
{
	public function handle($exe)
	{
		return $exe->next($exe);
	}
}
</code></pre>
<h5 style="font-size: 1.2em; margin-top: 20px;">load={filename}</h5>
<p>Load a middleware closure from a file relative to {App}/middleware directory.</p>
<pre><code>
$app->map->addRoutes(array(
	'general' => array(
		'path' => '/',
		'middleware' => 'load=general.php'
	)
));
</code></pre>
<p>It will look for a file named <span class='code-tag label label-file'>App/Middleware/general.php</span></p>
<p>The file <span class='label label-danger'>must</span> return a <span class='label label-class'>\Closure</span>.</p>
<pre><span class='code-tag label label-file'>App\Middleware\general.php</span><code>
return function($exe)
{
	return $exe->next($exe);
}
</code></pre>
<h5 style="font-size: 1.2em; margin-top: 20px;">route={general.about}</h5>
<p>Load a middleware closure from a file relative to <span class='label label-dir'>App/Middleware/routes/</span> directory.</p>
<pre><code>
$app->map->get('/about')->setMiddleware('route=general.about');
</code></pre>
<p>This code will look for <span class='label label-file'>App\Middleware\routes\general.about.php</span></p>
<p>Similar like previous one, the handler expects a returned <span class='label label-class'>\Closure</span>.</p>
<h5 style="font-size: 1.2em; margin-top: 20px;">true boolean on middleware property</h5>
<p>This pattern will look for a <u>file name <b>equal</b> to the route name</u> of the current route. It's similar like above pattern, except it's internally pre-defined.</p>
<pre><code>
$app->map->addRoutes(array(
	'backend' => array(
		'path' => '/admin',
		'middleware' => true
	)
));
</code></pre>
<p>This code will look for a file named <span class='label label-file'>App\Middleware\routes\backend.php</span></p>
<h2>3. Lookup registry</h2>
<h4 class='label label-method' style="">$app->middleware->register($name, $handler)</h4>
<p>Exedra provides you a way to register a middleware for later uses, through <span class='label label-method'>register</span> method on the <span class='label label-property'>$app->middleware</span> instance itself.</p>
<pre><code>
$app->middleware->register('auth', function($exe)
{
	return $exe->next($exe);
});

$app->middleware->register('csrf', App\Middleware\Csrf::class);
$app->middleware->register('rateLimiter', 'class=RateLimiter');
</code></pre>
<p>On which the name will be re-usable on application or route level.</p>
<pre><code>
$app->middleware->add('auth');
</code></pre>
<pre><code>
$app->map->any()->setMiddleware(['auth', 'csrf', 'rateLimiter']);
</code></pre>
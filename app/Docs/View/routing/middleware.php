<h1>Middleware</h1>
<p>Middleware is simply a layer(s) that surrounds your application runtime. In Exedra, the concept of middleware no longer bound to handling request/response only, but anything including your domain logic.</p>
<p>On the runtime, middlewares are stacked into the final call stack, and make no distinction whether it's global or route based.</p>
<h2>Adding a middleware</h2>
<h3>Global middleware</h3>
<p>The middleware added on application level will be stacked on every runtime.</p>
<pre><code>
$app->map->middleware(function($exe)
{
	return $exe->next($exe);
});
</code></pre>
<p>The <span class='label label-method'>\Exedra\Runtime\Exe::next()</span> method, basically tell the application to continue to the next call stack until the actual execution handler, unless breaked.</p>
<h3>Route based middleware</h3>
<p>Example on route based middleware, using convenient routing.</p>
<pre><code>
$app->map->any('/dashboard')->middleware(function($exe)
{
	// redirect to route with tag auth.
	if(!$exe->session->has('user'))
		return $exe->redirect->route('#auth');

	return $exe->next($exe);
});
</code></pre>
<p>Example on default routing</p>
<pre><code>
$app->map->addRoutes(array(
	'api' => array(
		'path' => '/admin',
		'middleware' => ['api-auth', 'rateLimiter', 'admin.php'] // refer the lookup registry 
	)
));
</code></pre>
<p>The route <span class='label label-property'>middleware</span> property accept single, or array of middleware.</p>
<h2>Handler</h2>
<p>The <span class='label label-method'>add</span> method on <span class='label label-property'>$app->middleware</span> instance, or the route <span class='label label-property'>middleware</span> property accept variety of handler pattern.</p>
<h3>\Closure</h3>
<pre><code>
$app->map->middleware(function($exe) {

});
</code></pre>
<h3>Fully qualified class name</h3>
<pre><code>
$app->middleware->add(\App\Middleware\Auth::class);
</code></pre>
<p>Will look for a class <span class='label label-class'>\App\Middleware\Auth</span> with the following handle</p>
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
<h2>Lookup registry</h2>
<p>Exedra provides you a way to register a middleware lookup for later uses, through <span class='label label-method'>register()</span> method on the <span class='label label-property'>$app->middleware</span>, a middleware registry instance itself.</p>
<pre><code>
$app->middleware->register('auth', function($exe)
{
	return $exe->next($exe);
});

$app->middleware->register('csrf', App\Middleware\Csrf::class);

$app->middleware->register('rateLimiter', \App\Middleware\RateLimiter::class);
</code></pre>
<p>On which the name will be re-usable on application or route level.</p>
<pre><code>
$app->middleware->add('auth');
</code></pre>
<pre><code>
$app->map->any()->middleware(['auth', 'csrf', 'rateLimiter']);
</code></pre>
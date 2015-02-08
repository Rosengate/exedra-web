<h1>Middleware <span>\Exedra\Application\Builder\Middleware</span></h1>
<p>This layer is actually part of the execution layer. It lives and encapsulate the original execution layer. They're also known as filter in other frameworks.</p>
<p>You may bind a middleware at the routing layer.</p>
<h2>1. Next()</h2>
<p><b>Next</b> method basically resembles the handler for the next closure it's executing.</p>
<pre><code>
$app->map->addRoute(array(
	'user'=>['uri'=>'user/[:username]', 'bind:middleware'=>function($exe)
		{
			// this next() encapsulates/handles the execution closure on user.profile
			return $exe->next($exe);
		}, 
		'subroute'=> array(
		'profile'=>['uri'=>'', 'execute'=> function()
		{

		}] //user.profile
	)] //user
));
</code></pre>
<h2>2. Bind by class</h2>
<p>You may also bind the middleware to which class should handle it.</p>
<pre><code>
$app->map->addRoute(array(
	'user'=>['uri'=>'user/[:username]', 'bind:middleware'=>'middleware=user',
	//... 
</code></pre>
<p>For this example, basically it will look for a middleware class, called MiddlewareUser, in default path app\middleware\user.php</p>
<p>If you didn't specify the method name, it will look for method named 'handle'</p>
<pre><code>
class MiddlewareUser
{
	public function handle($exe)
	{
		return $exe->next($exe);
	}
}
</code></pre>
<p>To specify the method name, you may do like this.</p>
<pre><code>
$app->map->addRoute(array(
	'user'=>['uri'=>'user/[:username]', 'bind:middleware'=>'middleware=user@myhandle',
	//... 
</code></pre>
<h2>3. Bind by path</h2>
<p>You may also specify a path, so it may load a path that should contain a handler (closure)</p>
<pre><code>
$app->map->addRoute(array(
	'user'=>['uri'=>'user/[:username]', 'bind:middleware'=>'middleware:user',
	//... 
</code></pre>
<p>And it will look for a handler in a file called user at app/middleware/user.php</p>
<pre><code>
// app/middleware/user.php
return function($exe)
{
	return $exe->next($exe);
};
</code></pre>
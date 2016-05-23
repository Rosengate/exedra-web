<h1>Overview</h1>
<p>In exedra application lifecycle, runtime is the actual moment an application gets executed, either through request dispatch(), or execute() method as explained in previous topic.</p>
<pre><code>
$app->map->get('/')->execute(function($exe)
{
	//.. the runtime
});
</code></pre>
<h2>Behind the scene</h2>
<p>Anything happened in the back, stay in the back.</p>
<h4>\Exedra\Application::dispatch()</h4>
<p>When an application gets executed, through http request dispatch for instance, exedra will first let the router dispatch the request through <span class='label label-method'>\Exedra\Routing\Level::findByRequest()</span>  down the depth of the routing map, recursively and intelligently traverse the nested routes, validate and route until it find the one it's looking for, and return in a proper finding.</p>
<h4>\Exedra\Routing\Finding</h4>
<p>Whether a route is found or not, a finding will be returned, on which the success is validatable with method <span class='label label-method'>\Exedra\Routing\Finding::isSuccess()</span>. On success, the finding basically resolves the array of middleware, route based config, meta informations and etc before being passed into the runtime construct.</p>
<h4>\Exedra\Runtime\Exe</h4>
<p>On the construct of this context, as a container itself, by defaults register number of dependencies, initialize empty response, and build a calls stack from an array of middleware and the runtime handler retrieved from the finding, before executing the stack and set the response body in the most stylish manner.</p>
<h2>An extreme example</h2>
<p>Have a nested routes, with number of middlewares bound at certain points.</p>
<pre><span class="code-tag label label-file">app/app.php</span><code>
$app->map->any('/')->group(function($group) {

	$group->middleware(\App\Middleware\All::class);

	$group->any('/books')->group('books.php');

	$aroup->any('/users')->group(function($users) {

		$users->middleware(\App\Middleware\Users::class);

		$users->post('/')->execute(function() {

		});

		$users->get('/[:id]')->execute(function() {

		});
	});
});
</code></pre>
<pre><span class="code-tag label label-file">app/Routes/books.php</span><code>
&lt;?php return function($books) {

	$books->middleware(\App\Middleware\Books::class);

	$books->get('/[:id]')->execute(function() {

	});

	$books->post('/')->execute(function() {

	});
};
</code></pre>
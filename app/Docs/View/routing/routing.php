<h1>Routing <span>\Exedra\Routing\.</span></h1>
<p>The main component of exedra, the entry point of a request dispatch. Every route is unique, and identifable by name, taggable and findable. They're reusable to the extent of generating a url for the route, doing a route based execution, or query a route even for your own use. In this page we'll focus on writing them.</p>
<h2>Overview</h2>
<p>Throughout the documentation, you'll often find most routing begins with <span class='label label-property'>$app->map</span>. This instance or <span class='label label-class'>\Exedra\Routing\Group</span> as we call it, is the first group of routes, unbounded to any route. It's registered as a service on application context itself.</p>
<h2>Http Request Verbs</h2>
<h3>GET, POST, PUT, PATCH, DELETE</h3>
<p>The first argument accept <span class='label label-property'>path</span>.</p>
<h5>GET /books with \Closure handler</h5>
<pre><code>
$app->map->get('/books')->execute(function($exe)
{
	return $exe->controller->execute('Book', 'index');
});
</code></pre>
<h5>POST /books with controller handler pattern</h5>
<pre><code>
$app->map->post('/books')->execute('controller=Book@add');
</code></pre>
<h5>DELETE /books/[:id]</h5>
<pre><code>
$app->map->delete('/books/[:id]')->execute('controller=Book@delete');
</code></pre>
<h5>PUT /books/[:id]</h5>
<pre><code>
$app->map->put('/books/[:id]')->execute('controller=Book@update');
</code></pre>
<h5>PATCH /books/[:id]/glossary</h5>
<pre><code>
$app->map->patch('/book/[:id]/glossary')->execute('controller=Book@updateGlossary');
</code></pre>
<h3>Any method or specify more than one</h3>
<p>Accept to any method. Expect the first argument as the string of route path.</p>
<pre><code>
$app->map->any('/books/[:action]')->execute('controller=Book@{action}');
</code></pre>
<p>Accept specified (case insensitive) methods.</p>
<pre><code>
$app->map->method(array('GET', 'post'), '/books/[:action]')->execute('controller=Book@{action}'	);
</code></pre>
<p>These <span class='label label-method'>get()</span>, <span class='label label-method'>post()</span>, <span class='label label-method'>put()</span>, <span class='label label-method'>delete()</span>, <span class='label label-method'>any()</span> and <span class='label label-method'>method()</span> api returns <span class='label label-class'>\Exedra\Routing\Route</span> instance.</p>
<h2>Route naming</h2>
<p>Create a named route through an array offset of the route group. Route name is useful on route finding functionality for url generator, and route based execution.</p>
<pre><code>
// returns \Exedra\Routing\Route
$app->map['api']->any('/api')->group(function($api)
{
	$api['author']->get('/author')->execute(function(){ });
});
</code></pre>
<p>Usage sample</p>
<pre><code>
echo $app->url->route('api.author'); // returns http://example.com/api/author
</code></pre>
<h4>Route tagging</h4>
<p>Similar with naming, but may even route finding by given tag only.</p>
<pre><code>
$app->map['api']->any('/api')->group(function($api)
{
	$api->post('/api/products')->tag('add-product')->execute(function(){ });
});
</code></pre>
<p>Usage sample</p>
<pre><code>
echo $app->url->route('#add-product');
</code></pre>
<p>Or prefix for more search specific.</p>
<pre><code>
echo $app->url->route('api.#add-product');
</code></pre>
</code></pre>
<h2>Route execute</h2>
<p>An handle for the runtime execution.</p>
<pre><code>
$app->map->any('/web')->execute(function(){ });
</code></pre>
<p>The <span class='label label-method'>execute()</span> method accept any type of value. Initially it accepts only a <span class='label label-class'>\Closure</span> and string of controller lookup. More information on <a href='javascript:docs.load("routing/handler");'>this topic.</a></p>
<h2>Named Parameter</h2>
<p>A segment of the URI path that can be named through routing, retrievable as a parameter through <span class='label label-class'>\Exedra\Runtime\Exe</span> instance.</p>
<p>Matches <span class='label label-string'>/web/about-us</span></p>
<pre><code>
$app->map['web']->any('/web/[:page]')->execute(function($exe)
{
	$page = $exe->param('page'); // about-us
});
</code></pre>
<h4>Optional parameter</h4>
<p>Matches <span class='label label-string'>/report</span> and <span class='label label-string'>/report/download</span></p>
<pre><code>
$app->map['admin']->any('/[:controller]/[:action?]')->execute(function($exe)
{
	$controller = $exe->param('controller');

	$action = $exe->param('action', 'index');
});
</code></pre>
<h4>Catch remaining path(s)</h4>
<p>Matches <span class='label label-string'>/book/edit/1/3/6</span></p>
<pre><code>
$app->map->any('/[:controller]/[*:action?]')->execute(function($exe)
{
	$action = $exe->param('action'); // will return 'edit/1/3/6'
});
</code></pre>
<h2>Nested Routing</h2>
<p>Setting <span class='label label-property'>subroutes</span> property by using <span class='label label-method'>group</span> method on the returned <span class='label label-class'>\Exedra\Routing\Route</span> instance.</p>
<pre><code>
$app->map->any('/api')->group(function($group)
{
	$group->any('/books')->group(function(\Exedra\Routing\Group $books)
	{
		$books->get('/', 'controller=Api\Book@index');

		$books->any('/[:id]', 'controller=Api\Book@view');
	});
});
</code></pre>
<p>This <span class='label label-method'>\Exedra\Routing\Route::group()</span> method is basically an alias to <span class='label label-method'>Route::setSubroutes()</span> method.</p>
<h4>Routing lookup</h4>
<p>Explicitly specify the routes to be looked up on.</p>
<pre><code>
$app->map->any('/admin')->group('admin.php');
</code></pre>
<p>The routing will by default find the routes in {root}/app/Routes directory.</p>
<pre><span class='code-tag label label-file'>/app/Routes/admin.php</span><code>
&lt?php
return function(\Exedra\Routing\Group $admin)
{
	$admin->any('/[:controller]/[*:action?]')
		->execute('controller={controller}@{action}');
};
</code></pre>
<h4>Routes lookup path</h4>
<p>The path of the file for the routes is relative to the one configured in the beginning of your application. By default, it's under <span class='label label-dir'>/{path.app}/Routes</span>. Initially you can however set like this.</p>
<pre><code>
$app->path['routes'] = 'path/to/routes/';
</code></pre>
<p>This path must be configured before any routing is done.</p>
<h2>Chainable API</h2>
<p>Most route property setter methods return the same instance, making it capable of chaining methods.</p>
<pre><code>
$app->map->get('/books')->execute('controller=Book@Index')->tag('bookList');
</code></pre>
<p>There's also a public method on the default <span class='label label-method'>Route</span> class to set properties you can use.</p>
<pre><code>
$app->map->get('/authors')->setProperties(array(
	'name' => 'author',
	'ajax' => true,
	'execute' => function()
	{

	}
));
</code></pre>
<p>Most properties are available as a setter method respectively.</p>
<pre><code>
$app->map->any()->middleware(function($exe)
	{
		return $exe->next($exe);
	})
	->tag('root')
	->execute('controller=Landing@index')
	->group(function($group)
	{
		$group->get('/about-us', 'controller=Landing@about');
	});
</code></pre>
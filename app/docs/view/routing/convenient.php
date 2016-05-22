<h1>Convenient Routing <span>\Exedra\Routing\.</span></h1>
<p>For developers that prefer some modern approach to routing, exedra also provides number of convenient methods that help with designing your routes.</p>
<h2>Http Verbs based routing</h2>
<h3>GET, POST, PUT, DELETE</h3>
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
<h3>Any method or specify more than one</h3>
<p>Listen to any method</p>
<pre><code>
$app->map->any('/books/[:action]')->execute('controller=Book@{action}');
</code></pre>
<p>Listen to specified methods</p>
<pre><code>
$app->map->add(array('get', 'post'), '/books/[:action]')->execute('controller=Book@{action}'	);
</code></pre>
<p>These get, post, put, delete, any and add method returns <span class='label label-class'>\Exedra\Routing\Route</span> instance.</p>
<h2>Nested Routing</h2>
<p>Setting <span class='label label-property'>subroutes</span> property by using <span class='label label-method'>group</span> method on the returned <span class='label label-class'>\Exedra\Routing\Route</span> instance.</p>
<pre><code>
$app->map->any('/api')->group(function($group)
{
	$group->any('/books')->group(function()
	{
		$group->get('/', 'controller=Api\Book@index');

		$group->any('/[:id]', 'controller=Api\Book@view');
	});
});
</code></pre>
<p>This <span class='label label-method'>\Exedra\Routing\Route::group()</span> method is basically an alias to <span class='label label-method'>Route::setSubroutes()</span> method.</p>
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
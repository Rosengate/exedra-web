<h1>Convenient Routing</h1>
<p>For developers that prefer some modern approach to routing, exedra also provides number of convenient methods that help with designing your routes.</p>
<p>First you need to specify the use of this approach, since it's not by default adapted.</p>
<pre><code>
$app->mapFactory->useConvenientRouting();
</code></pre>
<h2>1. HTTP Verbs based methods</h2>
<h3>1.1 GET, POST, PUT, DELETE</h3>
<p>The first argument accept <span class='label label-property'>path</span>. And the second one accept <span class='label label-property'>execute</span> property <b>OR</b> an array of properties, if an array is specified.</p>
<h5>GET /books with \Closure handler</h5>
<pre><code>
$app->map->get('/books', function($exe)
{
	return $exe->controller->execute('book', 'index');
});
</code></pre>
<h5>POST /books with controller handler pattern</h5>
<pre><code>
$app->map->post('/books', 'controller=Book@add');
</code></pre>
<h5>DELETE /books/[:id] with route properties</h5>
<pre><code>
$app->map->delete('/books/[:id]', array(
	'name' => 'book',
	'execute' => 'controller=Book@delete'
));
</code></pre>
<h5>PUT /books/[:id]</h5>
<pre><code>
$app->map->put('/books/[:id]', 'controller=Book@update')
</code></pre>
<h3>1.2. Specify none</h3>
<p>Specifying none, equals to a route with empty <span class='label label-property'>path</span> or <span class='label label-string'>'/'</span>, with no execution handler.</p>
<h3>1.2. Any or specify more than one</h3>
<p>Any kind of method</p>
<pre><code>
$app->map->any('/books/[:action]', 'controller=Book@{action}');
</code></pre>
<p>Specify method on first argument</p>
<pre><code>
$app->map->add(array('get', 'post'), '/books/[:action]', 'controller=Book@{action}');
</code></pre>
<p>These get, post, put, delete, any and add method returns <span class='label label-class'>Convenient\Route</span> instance, a child class for <span class='label label-class'>Route</span></p>
<h2>2. Subroutes/Route grouping</h2>
<p>Setting <span class='label label-property'>subroutes</span> property using this convenient method is easy by using <span class='label label-method'>group</span> method on the returned <span class='label label-method'>Convenient\Route</span> instance.</p>
<pre><code>
$app->map->any('/api')->group(function($group)
{
	$group->any('/books')->group(function()
	{
		$group->get('/', 'controller=Book@index');

		$group->any('/[:id]', 'controller=Book@view');
	});
});
</code></pre>
<p>This <span class='label label-method'>Convenient\Route::group()</span> method is basically an alias to <span class='label label-method'>Route::setSubroutes()</span> method.</p>
<h2>3. Chainable method</h2>
<p>Most <span class='label label-class'>Route</span> property setting methods return the same instance, making it capable of chaining methods.</p>
<pre><code>
$app->map->get('/books')->execute('controller=Book@Index')->tag('bookList');
</code></pre>
<p>P/S : <span class='label label-method'>Convenient\Route::execute()</span> and <span class='label label-method'>Convenient\Route::tag()</span> is an <b>alias</b> to <span class='label label-method'>Route::setExecute()</span> and <span class='label label-method'>Route::setTag()</span> methods respectively.</p>
<p>There's also a public method on the default <span class='label label-method'>Route</span> class to set properties you can use.</p>
<pre><code>
$app->map->get('/authors')->setProperties(array(
	'execute' => function()
	{

	}
));
</code></pre>
<p>Currently only <span class='label label-method'>execute</span>, <span class='label label-method'>tag</span>, and <span class='label label-method'>group</span> represent as alias for the property setting method respectively. While, you can still use the original <span class='label label-class'>Route</span> property setting method with no problem at all.</p>
<pre><code>
$app->map->any()
	->setMiddleware(function($exe)
	{
		return $exe->next($exe);
	})
	->setTag('root')
	->setExecute('controller=Landing@index')
	->setSubroutes(function($group)
	{
		$group->get('/about-us', 'controller=Landing@about');
	});
</code></pre>
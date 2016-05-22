<h1>Routing <span>\Exedra\Routing\.</span></h1>
<p>The main component of exedra, that basically front-route every single request for your application based on your designed map of routes. Every route is unique, and identifable by name. They're reusable to the extent of generating a url for the route, doing a route based execution, or query a route even for your own use. In this page we'll focus on writing them.</p>
<h2>Overview</h2>
<p>Throughout the documentation, you'll often find routing begins with <span class='label label-property'>$app->map</span>. This instance or <span class='label label-class'>\Exedra\Routing\Level</span> as we call it, is the first group/level of routes, unbounded to any route. It's registered as a service on application context itself.</p>
<h2>Default Routing <span>\Exedra\Routing\Level::addRoutes()</span></h2>
<p>In this topic, we'll be using a single method to add an array of routes, called <span class='label label-method'>\Exedra\Routing\Level::addRoutes()</span>. There's another much convenient way of routing, but they will be in the <a href='<?php echo $url->route('default', ['view' => 'routing/convenient']);?>'>next topic</a>.</p>
<h2>Basic</h2>
<p>The array structure consists of an associative list of routes with the <span class='label label-string'>key</span> as the compulsary route <span class='label label-property'>name</span>, against an array of properties for the route. Example :</p>
<pre><code>
$app->map->addRoutes(array(
	'book' => array(
		'method' => 'GET',
		'path' => '/books',
		'ajax' => false,
		'execute' => function()
		{
			return 'a list of books.';
		})
));
</code></pre>
<h2>Available Properties</h2>
<p>List of route properties is available in this <a href='<?php echo $url->create('default', ['view' => 'routing/properties']);?>'>page</a>. All of them are <b>optional</b>.</p>
<h2>Http Request method</h2>
<p>Accepting any method</p>
<pre><code>
$app->map->addRoutes(array(
	'book'	=> [
		'method' => 'any',
		'path' => '/book',
		'execute' => function(){ }],
	'authors' => [
		'path' => '/authors',
		'execute' => function(){ }]
	]
));
</code></pre>
<p>Specifying a single method</p>
<pre><code>
$app->map->addRoutes(array(
	'book'	=> [
		'method' => 'GET',
		'path' => '/book',
		'execute' => function(){ }]
));
</code></pre>
<p>Specifying array of methods</p>
<pre><code>
$app->map->addRoutes(array(
	'book' => [
		'method' => ['GET', 'POST'],
		'path' =>'/book',
		'execute' => function(){ }]
));
</code></pre>
<h2>Execute handler</h2>
<p>A property about how an execution should be handled. More on <a href='<?php echo $url->route('default', ['view' => 'runtime/handlers']);?>'>runtime/handlers</a>.</p>
<pre><code>
$app->map->addRoutes(array(
	'library' => [
		'method' => 'any',
		'path' => '/libraries'
		'execute' => $handler // an intermediate variable for example purpose
	]
));
</code></pre>
<p>This property represent the final handler in our stack of execution, preceded by an array of middlewares.</p>
<p>More on <a href='<?php echo $url->route('default', ['view' => 'runtime/handlers']);?>'>runtime/handlers</a>.</p>
<h2>URI path</h2>
<p>Mocking uri path <span class='label label-uri'>my/test</span> will execute route <span class='label label-route'>test</span>, and <span class='label label-uri'>my/test/path</span> will execute the route <span class='label label-route'>test2</span></p>
<pre><code>
$app->map->addRoutes(array(
	'test' 	=> [
		'path' => 'my/test',
		'execute' => function(){ }],
	'test2' => [
		'path' => 'my/test/path',
		'execute' => function(){ }]
));
</code></pre>
<h4>False URI path</h4>
<p>Setting up false flag on <span class='label label-property'>path</span>, will deny any HTTP request entry into that route. This may be good, if you want the route to solely be used somewhere.</p>
<pre><code>
$app->map->addRoutes(array(
	'error'=> ['path'=>false, 'execute'=> function(){ }]
));
</code></pre>
<h2>Named Parameter</h2>
<p>A segment of the URI path that can be named through routing, that can be retrieved as a parameter through <span class='label label-class'>\Exedra\Runtime\Exe</span> instance.</p>
<pre><code>
$app->map->addRoutes(array(
	'author-book' => [
		'path'=> '/books/[:author]/[:book-title]',
		'execute'=> function($exe)
		{
			return 'my-name is'. $exe->param('author') 
			.',and i have a books called '. $exe->param('book-title');
		}]
));
</code></pre>
<h3>Named parameter pattern validation</h3>
<h4>Accept any form</h4>
<pre><code>
$app->map->any('/[:book-title]')->execute(function(){ });
</code></pre>
<h4>Catch remaining path(s)</h4>
<pre><code>
$app->map->any('/[*:foos]')->execute(function($exe){ 
	return $exe->param('foos');
});
</code></pre>
<p>A dispatch on <span class='label label-uri'>/bar/baz/qux</span>, will print a string <span class='label label-string'>bar/baz/qux</span></p>
<h2>Nested Routing</h2>
<p>The main dish of exedra. Basically, exedra lets you nest a route into another route, then nest a route into another route, infinitely. The idea is, you can write a nestful and resource oriented URI design, and control the structure as per route node, through a bound middleware.</p>
<p>A default example :</p>
<pre><code>
$app->map->addRoutes(array(
	'user'=> [
		'path'=> 'user/[:username]',
		'subroutes'=> array(
			'profile'=> [
				'path' => '',
				'execute' => function($exe){ }],
			'book'=> ['path'=> 'book',
				'subroutes'=> array(
					'index'=> ['path'=> '', 'execute'=> function($exe){ }],
					'view'=> ['path'=> '[:book-title]', 'execute'=> function($exe){ }]
			)] // end of user.book
	)] // end of user
));
</code></pre>
<p>1. Mocking path <span class='label label-uri'>/user/john-doe</span> will execute route <b class='label label-route'>user.profile</b><br>
2. A path <span class='label label-uri'>/user/john-doe/book</span> will execute route <b class='label label-route'>user.book.index</b><br>
3. A path <span class='label label-uri'>/user/john-doe/book/alcataraz</span> will execute route <b class='label label-route'>user.book.view</b></p>
<h3>Specifying routing path</h3>
<p>It can be a convoluted mess in the beginning, so, you can explicitly specify a path of file of where it should look the nested routing at.</p>
<pre><code>
$app->map->addRoutes(array(
	'authors' => [
		'path' => '/authors',
		'subroutes' => 'authors.php'
	],
	'books' => [
		'path' => '/books',
		'subroutes' => 'books.php'
	]
));
</code></pre>
<p>The file MUST return a \Closure</p>
<pre><span class='code-tag label label-file'>/app/Routes/authors.php</span><code>
&lt;?php return function($authors)
{
	// convenient routing
	$authors->any('/[:id]')->group(function($author)
	{
		$author->addRoutes(array(
			'books' => array(
				'method' => 'GET',
				'path' => '/books',
				'execute' => function()
				{
					//.. return a list of books owned by this author!
				}
			)
		));
	});
};
</code></pre>
<h4>Routes lookup path</h4>
<p>The path of the location based routes is relative to the on configured in the beginning of your application. By default, it's under <span class='label label-dir'>/{path.app}/Routes</span>. Initially you can however set like this.</p>
<pre><code>
$app->path['routes'] = 'path/to/routes/';
</code></pre>
<p>And it'll define your path to <span class='label label-dir'>/path/to/routes</span>, relative to your root directory. More on <a href='<?php echo $url->route('default', ['view' => 'application/path']);?>'>path</a>.</p>
<h2>Module</h2>
<p>You may set sub-application as route parameter, using property <b class='label label-property'>module</b>. This will affect builder like controller and view on the current and following route to use the folder based on sub-application value set.</p>
<pre><code>
$app->map->addRoutes(array(
	'admin'=> [
		'path' => 'dashboard',
		'module' => 'admin',
		'subroutes' => array(
			'default' => [
				'path' => '[:controller]/[**:action]']
	)]
));
</code></pre>

<h2>Re-Routing</h2>
<p>You may execute another route within a successful execution. Either through the use of application instance, or the exec instance.</p>
<pre><code>
$app->map->addRoutes(array(
	'general'=> [
		'path'=> '',
		'subroutes'=> array(
			'error'=> 	[
				'path'=> '404',
				'execute'=> function(){ return "on error page"}],
		'by-app'=>	[
			'path' => 'by-app',
			'execute'=> function($exe) use($app) { return $app->execute('general.error')}],
		'by-exe'=>	[
			'path' => 'firstexe',
			'execute'=> function($exe){ return $exe->execute('error')}],
		'by-exe2'=> [
			'path' => 'secondexe',
			'execute'=> function($exe){ return $exe->execute('@general.error')}]
	)]
));
</code></pre>
<h4>Behaviour</h4>
1. By default, the <span class='label label-variable'>$exe</span> instance is relatively referred to the current <span class='label label-property'>base</span> route. <span class='label label-property'>base</span> can be set, else, it will use the parent route as the base route. Such affected component(s) are like <a href='<?php echo $url->create('default', ['view' => 'execution/components/url']);?>'>URL builder</a>.</p>
<p>
2. To escape and use the absolute route by the <span class='label label-variable'>$exe</span> instance, just use <b class='label label-string'>@</b> at the beginning of route.<br>
Example can be shown on route <span class='label label-route'>general.by-exe2</span>
</p>
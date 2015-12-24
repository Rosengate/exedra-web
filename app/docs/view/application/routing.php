<h1>Routing <span>\Exedra\Application\Map\.</span></h1>
<p>The main component of exedra, that basically front-route every single request for your application based on your designed map of routes. Every route is unique, and identifable by name (not really if you're using a <a href='<?php echo $url->create('default', ['view' => 'application/routing/convenient']);?>'>Convenient way of routing</a>). They're reusable to the extend of generating a url for the route, or query a route even for your own use. In this page we'll focus on writing them.</p>
<p>Let's just assume that we're using an <span class='label label-file'>App/app.php</span> from the <a href='<?php echo $url->create('default', ['view' => 'application/wizardry/start']);?>'>conjured skeleton</a> topic.</p>
<pre><span class='code-tag label label-file'>App/app.php</span><code>
return $exedra->build("App", function($app)
{

});
</code></pre>
<br>
<p>In this topic, we'll be using a single method to add route, called <span class='label label-method'>\Exedra\Application\Map\Level::addRoutes()</span>, which is available through <span class='label label-property'>map</span> property on our application <span class='label label-variable'>$app</span> instance. This method accept only array of routes. The structure is simple as below examples :</p>
<h2>1. Basic</h2>
<p>The array structure consists of an associative list of routes with the <span class='label label-string'>key</span> as the compulsary route <span class='label label-property'>name</span>, <b>against</b> an array of properties for the route.</p>
<pre><code>
$app->map->addRoutes(array(
	'book' => array(
		'method' => 'get',
		'path' => '/book',
		'execute' => function()
			{
				return 'a list of books.';
			}
		)
));
</code></pre>
<p>p/s : uri <span class='label label-string'>/book</span> or <span class='label label-string'>book</span> doesn't make a different uri, as the former one would be trimmed.</p>
<h2>2. Available Properties</h2>
<p>List of route properties is available in this <a href='<?php echo $url->create('default', ['view' => 'routing/properties']);?>'>page</a>. All of them are <b>optional</b>.</p>
<h2>3. Usages</h2>
<h3>3.1. HTTP Request method/verb</h3>
<p>On specifying or by any methods : </p>
<pre><code>
$app->map->addRoutes(array(
	'test'	=> [
		'method' => 'any',
		'path' => 'test-uri',
		'execute' => function(){ }], //any method
	'test2' => [
		'method' => ['get', 'post'],
		'path' =>'test-uri2',
		'execute' => function(){ }], //only permit GET and POST
	'test3' => [
		'path' =>'lasttest',
		'execute' => function(){ }] //not specifying will set permitted method to any methods.
));
</code></pre>
<h3>3.2. URI path</h3>
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
<h3>3.3. Named Parameter</h3>
<p>For every successful route execution, the handler will be given an instance of <span class='label label-class'>\Exedra\Application\Execution\Exec</span> through the first parameter.<br>
You may then retrieve the value of the named parameter through that instance with <span class='label label-method'>Exec::param()</span> method.</p>
<pre><code>
$app->map->addRoutes(array(
	'author-book' => [
		'path'=> 'books/[:author]/[:book-title]',
		'execute'=> function($exe)
		{
			return 'my-name is'. $exe->param('author') 
			.',and i have a books called '. $exe->param('book-title');
		}]
));
</code></pre>
<h3>3.4. Nested Routing</h3>
<p>Ah, the main dish of the exedra is finally here. Basically, exedra let you nest a route into another route, then nest a route into another route, infinitely. The idea is, to let you build a nestful and resource oriented URI design, and control the structure as per route node, through a bound middleware (covered later).</p>
<p>For example :</p>
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
<p>1. Executing URI <span class='label label-uri'>user/john-doe</span> will execute route <b class='label label-route'>user.profile</b><br>
2. Executing URI <span class='label label-uri'>user/john-doe/book</span> will execute route <b class='label label-route'>user.book.index</b><br>
3. Executing URI <span class='label label-uri'>user/john-doe/book/alcataraz</span> will execute route <b class='label label-route'>user.book.view</b></p>

<h3>3.5. False URI path</h3>
<p>Setting up false flag on <span class='label label-property'>path</span>, will deny an HTTP request entry into that route. This may be good, if you want the route to solely be used somewhere.</p>
<pre><code>
$app->map->addRoutes(array(
	'error'=> ['path'=>false, 'execute'=> function(){ }]
));
</code></pre>
<h3>3.6. Module</h3>
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

<h2>4. Re-Routing</h2>
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
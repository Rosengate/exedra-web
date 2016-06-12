<style type="text/css">
	
.table-container
{
}

.table-container td
{
	border-bottom: 1px solid #d6d6d6;
	padding: 3px;
}

</style>
<h1>Application as a container</h1>
<p>Being a class derived from our own dependency injection container, this behaviour grants developer a convenience of writing and lazily wiring up your application.</p>
<h2>Register your own dependency</h2>
<p>Having the same behaviour of the container it inherited, there're three 3 types of dependency they could be registered as. A service, factory, or callable.</p>
<h3>Service</h3>
<p>A service last for the lifetime of the application, and return the same value each time.</p>
<p>An example on adding a service with add() method.</p>
<pre><code>
$app['service']->add('db', function()
{
	$db = $this->config['db'];

	$string = 'mysql:host='.$db['host'].';dbname='.$db['name'];

	$pdo = new \Pdo($string, $db['user'], $db['pass']);

	return $pdo;
});
</code></pre>
<p>And reuse the service later.</p>
<pre><code>
$statment = $app->db->query('SELECT * FROM foo');
</code></pre>
<h3>Factory</h3>
<p>A factory helps you create the dependency you needed.</p>
<pre><code>
$app['factory']->add('rest-controller', function($name, $action, array $params = array())
{
	$controller = new '\\App\\Controller\\'.ucfirst($name);

	$action = strtolower($this->request->getMethod()).ucfirst($action);

	return call_user_func_array(array($controller, $action), $params);
});
</code></pre>
<p>And call the factory</p>
<pre><code>
$app->create('rest-controller', array('book', 'list'));
</code></pre>
<h3>Callable</h3>
<pre><code>
$app['callable']->add('@log', function($message)
{
	$this->log->create($mesasge);
});
</code></pre>
<p>And the callable is invokable on the application instance.</p>
<pre><code>
$app->log('Something not well.');
</code></pre>
<h2>Share dependency</h2>
<p>By design, the execution runtime itself is a subset of an application context, but the context itself isn't the same one as application's, so it's not possible to retrieve the dependency <u>directly</u> on the execution context, except through a shared registry.</p>
<p>The registry is done on the application context, and have the name prefixed with '@' character. For example :</p>
<pre><code>
$app['callable']->add('@query', function($query)
{
	return $this->db->query($query);
});
</code></pre>
<p>And later on the runtime, you may retrieve by usual mean.</p>
<pre><code>
$app->any('/')->execute(function($exe)
{
	return $exe->query('SELECT * FROM user');
});

$app->dispatch();
</code></pre>
<h2>Predefined dependencies</h2>
<p>There're number of services and factories already defined internally, and of course it's overwriteable on the start of your application :</p>
<h4>Services</h4>
<table class='table-container'>
	<tr><th style="width: 150px;">Name</th><th style="width: 130px;">Registry name</th><th>Description</th></tr>
	<tr><td>Map factory</td><td>$app->mapFactory</td><td>A routing factory, that manage the creation of objects</td></tr>
	<tr><td>Initial Routing Level</td><td>$app->map</td><td>Initial routing group/level</td></tr>
	<tr><td>Execution registry</td><td>$app->execution</td><td>A registry handling information on how to handle execution.</td></tr>
	<tr><td>Middleware registry</td><td>$app->middleware</td><td>A middleware lookup registry</td></tr>
	<tr><td>Http Request</td><td>$app->request</td><td>Http Server Request Instance</td></tr>
	<tr><td>Url Generator</td><td>$app->url</td><td>Handle url generation</td></tr>
	<tr><td>@Session</td><td>$app->session</td><td>A php native session service.</td></tr>
	<tr><td>@Flash</td><td>$app->flash</td><td>A flash instance built on top session service</td></tr>
	<tr><td>Wizard Manager</td><td>$app->wizard</td><td>A wizard manager on managing commands</td></tr>
</table>
<hr/>

<h4>Factories</h4>
<table class='table-container'>
	<tr>
		<th>Name</th>
		<th>Registry Name</th>
		<th>Description</th>
	</tr>
	<tr><td>Execution instance</td><td>execution.exe</td><td></td></tr>
	<tr><td>Execution handlers</td><td>execution.handlers</td><td></td></tr>
</table>
<h3>Overwriting existing registry</h3>
<p>A similar method to add(), but it does not throw any exception if the registry already exist.</p>
<pre><code>
$app['service']->set('session', '\Foo\SessionManager');
</code></pre>
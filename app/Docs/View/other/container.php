<h1>Dependency Injection Container</h1>
<p>Handles dependency registry, and resolves dynamically.</p>
<h2>Create a container</h2>
<p>Create a new container</p>
<pre><code>
$container = new \Exedra\Container\Container;
</code></pre>
<h2>Dependency Registry</h2>
<p>There're three 3 types of dependency they could be registered as. A service, factory, or callable. These registries are accessible through the offset key or as property of the container.</p>
<h3>Service</h3>
<p>A service last for the lifetime of the container, and return the same value each time.</p>
<p>An example on adding a service with add() method.</p>
<h4>add(<em>String</em> $name, <em>mixed</em> $value)</h4>
<p>The second argument can be a <span class='label label-type'>string</span> of a fully qualified class name.</p>
<pre><code>
$container['service']->add('task', '\App\TaskManager');
</code></pre>
<p>Or an <span class='label label-type'>array</span> with first element as the class name, and second as an array of construct arguments in the form of dependency names.</p>
<pre><code>
$container['service']->add('session', array('cron', array('\App\CronRegistry', array('self.task'))));
</code></pre>
<p>Or a <span class='label label-type'>\Closure</span>.</p>
<pre><code>
$container['service']->add('db', function()
{
	$config = $this->dbconfig;

	$string = 'mysql:host='.$config['host'].';dbname='.$config['name'];

	$pdo = new \Pdo($string, $config['user'], $config['pass']);

	return $pdo;
});
</code></pre>
<p>For \Closure type, <span class='label label-property'>$this</span> refer to the container itself, and must return the dependency.</p>
<h3>Factory</h3>
<p>A factory helps you create the dependency you needed.</p>
<pre><code>
$container['factory']->add('rest-controller', function($name, $action, array $params = array())
{
	$controller = new '\\App\\Controller\\'.ucfirst($name);

	$action = strtolower($this->request->getMethod()).ucfirst($action);

	return call_user_func_array(array($controller, $action), $params);
});
</code></pre>
<h4>create(<em>String</em> $name, <em>Array</em> $args)</h4>
<p>And you may create the dependency through the <span class='label label-method'>create()</span> method. The first argument receive the name of the dependency. The second receives an array of argument.</p>
<pre><code>
$container->create('rest-controller', array('book', 'list'));
</code></pre>
<h3>Callable</h3>
<p>A 'dynomagically' create a callable method on the container itself.</p>
<pre><code>
$container['callable']->add('@log', function($message)
{
	$this->log->create($mesasge);
});
</code></pre>
<p>And the callable is invokable on the application instance.</p>
<pre><code>
$container->log('Something not well.');
</code></pre>
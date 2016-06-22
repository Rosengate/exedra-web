<h1>A container</h1>
<h2>\Exedra\Runtime\Exe as a container</h2>
<p>Similar like <span class='label label-class'>\Exedra\Application</span>, <span class='label label-class'>\Exedra\Runtime\Exe</span> is also also built as a container, for the convenience of registering services on developer own terms.</p>
<h4>Wiring up the container</h4>
<p>So, if it begins by the moment your application gets executed, where does one wire up the runtime based services?</p>
<p>The goal of exedra, about actually being hierarchical and nestful in design, are partly achieved through the leveraged use of middleware. And middleware, being the layer that encompasses, is the most suitable place to wire up the container.</p>
<h4>Example on registering some services</h4>
<pre><code>
$app->map->middleware(function($exe)
{
	// exe->layout
	$exe['service']->add('layout', function()
	{
		return $this->view->create('layout/default');
	});

	// exe->render()
	$exe['callable']->add('render', function($view, array $data = array())
	{
		$view = $this->view
			->create($view)
			->set($data);

		return $this->layout
			->set('view', $view)
			->render();
	});

	return $exe->next($exe);
});
</code></pre>
<p>Learn more about middleware.</p>

<h2>Predefined dependencies</h2>
<p>There're number of services and factories already defined internally, and of course it's overwriteable.</p>
<h4>Services</h4>
<table class='table-container'>
	<tr><th style="width: 150px;">Name</th><th style="width: 130px;">Registry name</th><th>Description</th></tr>
	<tr><td>View Factory</td><td>$exe->view</td><td>A view factory, helps with the creation of view.</td></tr>
	<tr><td>Controller Factory</td><td>$exe->controller</td><td>Helps with the creation or execution of controller.</td></tr>
	<tr><td>Config</td><td>$exe->config</td><td>A cloned application config, to preserve the immutability state.</td></tr>
	<tr><td>Url Generator</td><td>$exe->url</td><td>Handle URL generation.</td></tr>
	<tr><td>Redirect</td><td>$exe->redirect</td><td>Helps with redirection.</td></tr>
	<tr><td>Form</td><td>$exe->form</td><td>Excellently help with form inputs' creations.</td></tr>
	<tr><td>Request</td><td>$exe->request</td><td>Executed http request. Returns null if the route was executed without a request.</td></tr>
	<tr><td>Response</td><td>$exe->response</td><td>An empty http reponse.</td></tr>
	<tr><td>Path</td><td>$exe->path</td><td>An uncloned application path.</td></tr>
</table>
<h4>Factories</h4>
<table>
	<tr><th style="width: 150px;">Name</th><th style="width: 130px;">Registry name</th><th>Description</th></tr>
	<tr><td>Url</td><td>factory.url</td><td></td></tr>
</table>
<h3>Overwriting existing registry</h3>
<p>A similar method to add(), but does not throw any exception if the registry already exist.</p>
<pre><code>
$exe['service']->set('session', '\Foo\SessionManager');
</code></pre>
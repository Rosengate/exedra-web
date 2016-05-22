<h1>A container</h1>
<h2>\Exedra\Runtime\Exe as a container</h2>
<p>Similar like <span class='label label-class'>\Exedra\Application</span>, <span class='label label-class'>\Exedra\Runtime\Exe</span> is also also built as a container, for the convenience of registering services on developer own terms.</p>
<h4>The question of wiring up the container</h4>
<p>So, if it begins by the moment your application gets executed, where does one wire up the runtime based services?</p>
<p>The goal of exedra, about actually being hierarchical and nestful in design, are partly achieved through the leveraged use of middleware. And middleware, being the layer that encompasses, is the most suitable place to wire up the container.</p>
<h4>Example on registering some services</h4>
<pre><code>
$app->map->middleware(function($exe)
{
	$exe['services']->add('layout', function()
	{
		return $this->view->create('layout/default');
	});

	$exe['callables']->add('render', function($view, array $data = array())
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
</table>
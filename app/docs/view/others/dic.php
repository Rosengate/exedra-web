<h1>DI Container <span>\Exedra\Application\Container</span></h1>
<p>This container provides you some legal way to help you resolve your dependency(s).</p>
<h2>1. Execution</h2>
<p>On execution instance ($exe), there's a dependency injection container with property named <b>$di</b>, that let you register your dependency for the $exe instance itself. Most of the components for this layer are registered through this container. And you may still register through your own, or, re-register one of the layer's component.</p>
<h3>1.1 Register Dependency :</h3>
<pre><code>
$exe->container->register('layout', function() use($exe)
{
	return $exe->view->create('layout/default');
});
</code></pre>
<p>You may later retrieve by just calling the dependency as the property off the $exe instance itself.</p>
<pre><code>
$exe->layout->render();
</code></pre>
<h3>1.2. Nested Container</h3>
<p>Or you may want to create another container within a container.</p>
<pre><code>
$exe->container->register('mycontainer', function() use($exe)
{
	$mycontainer = new \Exedra\Application\Container;

	// and register another here.
	$mycontainer->register('layout', function() use($exe)
	{
		return $exe->view->create('layout/default');
	});

	return $mycontainer;
});
</code></pre>
<p>And you may use it through this way for example</p>
<pre><code>
$exe->mycontainer->layout->render();
</code></pre>
<h3>1.3. Auto-resolve</h3>
<p>In case you wondered, the the Exec ($exe) instance itself, already has <b>__get</b> magic method to help resolve the dependencies registered on $exe->container. However you may still resolve the dependency, through the DI instance itself if you want.<br>For example :</p>
<pre><code>
$exe->container->resolve('url')->create('myroute');
</code></pre>
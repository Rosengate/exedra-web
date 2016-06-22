<h1>Service Provider</h1>
<p>There might be a moment you want to create a package for exedra, or as provider to bridge with existing packages out there.</p>
<h2>Registering a service provider</h2>
<p>Each registered provider must implement <span class='label label-type'>\Exedra\Provider\ProviderInterface</span></p>
<pre><code class="php">
//.. sample provider
namespace Taskful\Support;

class Provider implements \Exedra\Provider\ProviderInterface
{
	public function register(\Exedra\Application $app)
	{
		$app['service']->add('task.manager', function()
		{
			$config = $this->config->get('taskful');

			return new \Taskful\Manager($config);
		});
	}
}
</code></pre>
<p>Then register through <span class='label label-class'>add()</span> method.</p>
<pre><code>
$app['service']->add(\Taskful\Support\Provider::class);
</code></pre>
<h3>Lazy/deferred provider</h3>
<p>A provider may only get registered on provided/specified services required/invoked by your application.</p>
<h4>Specifying on provider side</h4>
<p>Implement a <span class='label label-method'>provides()</span> method. The method must return an array.</p>
<pre><code>
//.. your provider.
public function provides()
{
	return array('task.manager');
}
</code></pre>
<h4>Specifying on application side</h4>
<p>Or get registered only when specified dependencies invoked.</p>
<pre><code>
$app['provider']->add(\Taskful\Support\Provider::class, array('task.manager', 'callable.taskIn'));
</code></pre>
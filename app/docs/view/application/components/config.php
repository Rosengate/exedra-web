<h1>Configuration <span>\Exedra\Application\Config</span></h1>
<p>Exedra has so very little to none configuration you can do in order to run your application up. In fact, the moment you booted up exedra, and set up some basic routing, everything should already be working. But there're times you may want to configure some parameters for your application.</p>
<p>Exedra provides a simple component to handle configuration. The instance of configuration is retrievable through the application (<span class='label label-variable'>$app</span>) instance.</p>
<pre><code>
$config = $app->config;
</code></pre>
<h2>1. set</h2>
Set the configuration data.
<pre><code>
$app->config->set('admin.name', 'danny');
</code></pre>
<p>Or by array</p>
<pre><code>
$app->config->set([
	'admin.email'=>'danny@gmail.com',
	'facebookAppId'=>'192312481'
]);
</code></pre>
<h2>2. get</h2>
<p>Retrieve the configuration data</p>
<pre><code>
$adminemail = $app->config->get('admin.email');
</code></pre>
<h2>3. has</h2>
<p>Check configuration existence</p>
<pre><code>
if($app->config->has('admin'))
{
	// be my guest
}
</code></pre>
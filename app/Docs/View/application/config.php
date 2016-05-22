<h1>Config</h1>
<p>A configuration bag, with sets of common methods. A dot notation array capable.</p>
<h2>get</h2>
<p>Get a configuration value</p>
<pre><code>
$foo = $app->config->get('foo');
</code></pre>
<h2>set</h2>
<p>Set a configuration value</p>
<pre><code>
$app->config->set('foo', 'bar');
</code></pre>
<h4>Muti-dimensional set</h4>
<pre><code>
$app->config->set('foo.bar', 'baz');

$app->config->set('foo.tux', 'bat');
</code></pre>
<p>And if your retrieve by the parent key</p>
<pre><code>
$bartux = app->config->get('foo'); // will return an array of ('bar' => 'baz', 'tux', 'foo')
</code></pre>
<h2>has</h2>
<p>Check if configuration exists</p>
<pre><code>
if($app->config->has('foo'))
{
}
</code></pre>
<h1>Exe as a Parameter Holder</h1>
<p>Handle named parameter(s) from the executed route.</p>
<h2>param()</h2>
<p>The main method to retrieve route's named parameter.</p>
<pre><code>
$app->map->any('/[:username]/[:action]')->execute(function($exe)
{
	$username = $exe->param('username');

	$action = $exe->param('action');
});
</code></pre>
<h2>setParam()</h2>

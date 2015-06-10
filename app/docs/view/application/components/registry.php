<h1>Registry</h1>
<p>An instance to handle certain registry for execution purpose.</p>
<h2>1. addMiddleware</h2>
<p>You may add or stack a middleware without even defining them on route yet. The middlewares stacked by this method will surely be executed on every request.</p>
<pre><code>
$app->registry->addMiddleware(function($exe)
{
	return $exe->next($exe);
});
</code></pre>
<h2>2. setFailRoute</h2>
<p>You may also register a route if your application is failing by \Exception thrown either by the framework, or even by your application.</p>
<pre><code>
$app->registry->setFailRoute('error');
</code></pre>
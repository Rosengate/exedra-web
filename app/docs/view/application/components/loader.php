<h1>Loader</h1>
<p>Exedra provides a common loader that is usable within 3 scope level. The Exedra instance, the Application instance, and the Exec ($exe) instance. This scope based loader has nothing difference, except that they're prefixed by the directory the instances were based on.</p>
<h2>1. Instances</h2>
<hr style="border-color:#e5e5e5;">
<h4>1.1. Exedra</h4>
<p>The directory for this instance are decided by first argument given, when creating exedra</p>
<pre><code>
$dir = __DIR__; // current dir.
$exedra = new \Exedra\Exedra($dir);
</code></pre>
<h4>1.2. Application</h4>
<p>For this instance, the loader will be based on app folder name.</p>
<pre><code>
$myapp = $exedra->build('app', function($app)
{
	// the root of loader would be under folder /app/

});
</code></pre>
<h4>1.3. Exec</h4>
<p>And for this instance, the loader will be based on <b>subapp</b> configured in routing, if there's no subapp configured, it will use the application directory instead.</p>
<pre><code>
$myapp = $exedra->build('app', function($app)
{
	$app->map->addRoute(array(
		'test'=> ['uri'=> 'test', 'subapp'=> 'backend', 'execute'=> function($exe)
		{
			// the loader will be based on /app/backend/
		}]
	));
});
</code></pre>
<hr style="border-color:#e5e5e5;">
<h2>2. load</h2>
<p>Return a require_once of a file</p>
<h3>2.1 By string</h3>
<pre><code>
$app->loader->load('storage/myfile.php');
</code></pre>
<h3>2.2 By associative array</h3>
<p>Two currently acceptable key</p>
<ol>
	<li>structure (optional)</li>
	<li>path (mandatory)</li>
</ol>
<pre><code>
$app->loader->load(array('structure'=>'storage', 'path'=> 'myfile.php'));
</code></pre>
<p>Load a file while array as a second argument to be extracted.</p>
<pre><code>
$app->loader->load(
	array('structure'=> 'storage', 'path'=> 'myfile.php'),
	array('myvar'=> 'helloworld'));
</code></pre>
<h2>3. getContent</h2>
<p>Get file contents. Basically uses php function <b>file_get_contents</b>.</p>
<pre><code>
$contents = $app->loader->getContents(['structure'=> 'storage', 'path'=> 'world/data.json']);
</code></pre>
<h2>4. registerAutoload</h2>
<p>Register an autoloadable classes path. This method is available by any loader of any instance based.</p>
<p>Register by passed string.</p>
<pre><code>
$exedra->registerAutoload('myclasses');
</code></pre>
<p>Register by list of path. Let us use $app instance based for this once.</p>
<pre><code>
// within the application context.
$app->loader->registerAutoload('model/entities');
</code></pre>
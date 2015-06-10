<h1>Path  <span>\Exedra\Application\Builder\Path</span></h1>
<p>An instance to help you with path creation across your application.</p>
<h2>1. create</h2>
<p>Example codes on creating path. This method creates <strong>\Exedra\Application\Builder\Blueprint\Path.</strong></p>
<pre><code>
// by $app instance
$mypath = $app->path->create('schemas/database.yml');

// or by $exe instance
$mypath = $exe->path->create('schemas/markups.json');
</code></pre>
<h2>2. load</h2>
<p>A method to load php file relative to the current context.</p>
<pre><code>
$mypath = $app->path->create('foo/bar.php')->load();
</code></pre>
<p>Load the path with extracted variables. (load() is equavalent to include() in php)</p>
<pre><code>
$mypath->load(array('myvar' => 'foobar'));
</code></pre>
<p>You may also create path using the $exe instance. And the path will be sub-prefixed with the module name of the current execution.</p>
<pre><code>
$mypath = $exe->path->create('foo/bar.php');
</code></pre>
<h2>3. toString</h2>
<p>Get the string version of the path</p>
<pre><code>
// return app/foo/bar.php
echo $mypath->toString();
</code></pre>
<h2>3. getContents</h2>
<p>Get file contents</p>
<pre><code>
$infoBar = $exe->path->create('foo/info.json')->getContents();
</code></pre>
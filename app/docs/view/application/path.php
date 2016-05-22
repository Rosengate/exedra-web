<h1>Path <span>\Exedra\Path</span></h1>
<p>A registry of directory locations.</p>
<h2>Initial path registry</h2>
<p>There're currently 4 paths initially registered at the construct of your application.</p>
<h4>path.root</h4>
<p>A mandatory root path of your project.</p>
<pre><code>
echo (string) $app->path;
</code></pre>
<p>Or you can access the root path from the offset, it's the same instance.</p>
<pre><code>
echo (string) $app->path['root'];
</code></pre>
<h4>path.app</h4>
<p>Path to the meat of your application, location of your domain codes. This directory will also be autoloaded on application instantiation, with the configured namespace.</p>
<pre><code>
echo (string) $app->path['app'];
</code></pre>
<h4>path.public</h4>
<p>The public facing directory of your project.</p>
<pre><code>
echo (string) $app->path['public'];
</code></pre>
<h4>path.routes</h4>
<p>A lookup routes for your routing factory.</p>
<pre><code>
echo (string) $app->path['routes'];
</code></pre>
<h2>Path registry</h2>
<h4>Register a path</h4>
<p>Register a new path directly under root path.</p>
<p>The first argument receieve path registry name, and the second receieve a directory, relative to the path.root.</p>
<pre><code>
$app->path->register('storage', 'storage');
</code></pre>
<p>Or you can set an absolute location, by passing boolean true as the third argument.</p>
<pre><code>
$app->path->register('server', '/var/server', true);
</code></pre>
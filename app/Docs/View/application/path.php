<h1>Path <span>\Exedra\Path</span></h1>
<p>A registry of directory locations.</p>
<h2>Initial application path registry</h2>
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
<p>Register a path wih a given <span class='label label-class'>\Exedra\Path</span> type.</p>
<pre><code>
$app->path->register('vault', new \Exedra\Path($absolutePath));
</code></pre>
<h4>Get the registered path</h4>
<p>Get the registered path with get method</p>
<pre><code>
$storagePath = $app->path->get('storage');
</code></pre>
<p>Or get it as an array offset.</p>
<pre><code>
$serverPath = $app->path['server'];
</code></pre>
<h2>Operations</h2>
<p>Number of useful methods.</p>
<h4><em style='opacity: 0.5;'>String</em> to</h4>
<p>Get absolute path to the given argument in string</p>
<pre><code>
$pdf = $app->path->to('public/files/love-letter.pdf');

$image = $app->path['public']->to('images/love.png');
</code></pre>
<h4><em style='opacity: 0.5;'>Mixed</em> load</h4>
<p>Require given path</p>
<pre><code>
$conf = $app->path['storage']->load('caches/conf.json');
</code></pre>
<h4><em style='opacity: 0.5;'>Boolean</em> has</h4>
<p>Check whether path exists</p>
<pre><code>
if($app->path->has('env')){
	
}
</code></pre>
<h4><em style='opacity: 0.5;'>Void</em> autoloadPsr4</h4>
<p>Autoload given path.</p>
<pre><code>
$app->path->autoloadPsr4('Myriad', 'src/Myriad');
</code></pre>
<p>Autoloaded path is relative to the current path instance. To do an absolute autoload, pass boolean false as third argument.</p>
<pre><code>
$app->path->autoloadPsr4('Slim', '/var/packages/slim/src', false);
</code></pre>
<h4><em style='opacity: 0.5;'>\Exedra\File</em> file</h4>
<p>Create <span class='label label-class'>\Exedra\File</span> object. A subclass of <span class='label label-class'>\SplFileInfo</span>.</p>
<pre><code>
$schema = $app->path['config']->file('db/schema.php');
</code></pre>
<h4><em style='opacity: 0.5;'>\Exedra\Path</em> create</h4>
<p>Create a new <span class='label label-class'>\Exedra\Path</span> relatively.</p>
<pre><code>
$newPath = $app->path->create('path/to/newpath');
</code></pre>
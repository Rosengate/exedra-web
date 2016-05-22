<h1>Overview</h1>
<h2>\Exedra\Application</h2>
<p>The main instance of your application, and a container to number of services.</p>
<pre><code>
$app = new \Exedra\Application(__DIR__);
</code></pre>
<p>The argument for the class accept <span class='label label-primary'>[string]</span> as your application root path, <b>or</b> an <span class='label label-primary'>[array]</span> of paths and namespace. In the example above, we pass root path (string) as the only argument.</p>
<p>It's possible to configure your own paths and namespace initially, and it's mandatory to have the path.root configured.</p>
<pre><code>
$app = new \Exedra\Application(array(
	'path.root' => __DIR__,
	'path.public' => __DIR__.'/public',
	'path.app' => __DIR__.'/app',
	'path.routes' => __DIR__.'/app/Routes',
	'namespace' => 'App'
));
</code></pre>
<p>As you can see here, we defined several paths and a namespace of your application, basically they resemble below structure</p>
<pre><code>
| ─ root
|   ─ app
|     ─ Routes
|   ─ public
</code></pre>
<h2>Namespace</h2>
<p>The configured namespace will be autoloaded within the configured path.app. By default, we use <span class='label label-class'>App</span> as your namespace. For example :</p>
<pre><code>
| ─ root
    ─ app
      ─ Entity
        ─ Person.php
</code></pre>
<p>The Person class above will have a full name like <span class='label label-class'>\App\Entity\Person</span></p>
<h2>\Exedra\Path</h2>
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
<p>More on <a href='<?php echo $url->route('default', ['view' => 'application/path']);?>'>path</a>.</p>
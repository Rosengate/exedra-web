<h1>Booting Up Application</h1>
<p>There's little to minimal configuration to get your application running.</p>
<h2>Application Boot</h2>
<p>Your application begin the soon it's instantiated.</p>
<h3>/app.php</h3>
<p>Let's create a file called <span class='label label-file'>app.php</span> just under your root <span class='label label-dir'>/</span> directory.</p>
<p>You can place this boot-file anywhere if you want, as long as you understand several path configuration initially needed to be set up.</p>
<pre><span class='code-tag label label-file'>/app.php</span><code>
&lt;php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);
</code></pre>
<p>Basically it's the same as doing below :</p>
<pre><span class='code-tag label label-file'>/app.php</span><code class='php'>
&lt;php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(array(
	'path.root' => __DIR__,
	'path.app' => __DIR__.'/app',
	'path.public' => __DIR__.'/public',
	'path.routes' => __DIR__.'/app/Routes'
	'namespace' => 'App'
));

return $app;
</code></pre>
<p>And make sure you return the application instance.</p>
<h2>Additional Set up</h2>
<p>Additionally you can set up these files if you want.</p>
<h3>/app</h3>
<p>Contain most of your codes, your domain logic, and most importantly your application code. It's autoloaded with the configured namespace. The name can be changed by the specified path.app path. At the beginning, this directory will be empty.</p>
<p>But, you may create it if you want.</p>
<h3>/wizard</h3>
<p>Exedra came out with a little and simple collection of console commands called wizard.</p>
<p>Create a file named <span class='label label-file'>wizard</span> under the root <span class='label label-dir'>/</span> directory.</p>
<pre><span class='code-tag label label-file'>/wizard</span><code>
&lt;php
// require the app.php file
$app = require_once __DIR__.'/app.php';

$app->wizard($argv);
</code></pre>
<p>More on <a href='<?php echo $url->route('default', ['view' => 'wizard/overview']);?>'>wizard</a>.</p>
<h3>/public/</h3>
<p>The directory of where your web files including front controller (index.php) be placed, assuming that the <span class='label label-file'>path.public</span> remains.</p>
<p>Within this folder let's create an index.php file.</p>
<h4>/public/index.php</h4>
<pre><span class='code-tag label label-file'>/public/index.php</span><code>
&lt;php
// require the app.php file
$app = require_once __DIR__.'/../app.php';

$app->dispatch();
</code></pre>
<p>This file serve as an http request entry / front controller of your application.</p>

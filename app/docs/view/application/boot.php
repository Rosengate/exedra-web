<h1>Booting Exedra</h1>
<p>Exedra uses front-controller pattern, which acts as the main handler for every incoming request. For a simple booting up example, we'll use just <span class='label label-file'>index.php</span> as the main front-controller. But first, make sure you've already cloned exedra somewhere in your disk.</p>
<h2>1. Include Exedra and build</h2>
<p>Require Exedra in your index.php (from wherever you put exedra), and boot your application up just like this : </p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";
</code></pre>
<p>Or use any convenient way like composer, for example.</p>
<pre><code>
require_once "../vendor/autoload.php";
</code></pre>
<p>Then, just instantiate the core instance itself, Exedra. And create the application instance using <b>build</b> method.</p>
<pre><code>
$exedra = new \Exedra\Exedra(__DIR__);
$app = $exedra->build("App", function($app)
{
	// the main closure to do all sort of routing.
});

</code></pre>
<p>The <b>first argument</b> of exedra::build passed is supposed to be your application folder name (in this case <span class='label label-string'>'App'</span>). <br>We'll <a href='<?php echo $exe->url->create('default', ['view'=>['application','components', 'application']]);?>'>cover this later</a>. <br>Okay, to test the application, we can <b>mock the application</b>, without dispatching any HTTP request yet.<br><br>
Write below code outside of the main closure, and <u>expect the simple thrown exception</u> because no routing has been done yet.</p>
<pre><code>
echo $app->execute(array('method' => 'GET', 'path' => 'test'));
</code></pre>
<p>Then, let us write a simple routing, to match the exact URI path. Refresh the page, and expect the returned result.</p>
<pre><code>
$app = $exedra->build("App", function($app)
{
	// the main closure to do all sort of routing.
	$app->map->addRoutes(array(
		'first-test'=> array(
			'method'=> 'any',
			'path'=> 'test',
			'execute'=> function()
			{
				return "My first route!";
			})
		));
});
</code></pre>
<p>You may also execute the route by just calling the route name :</p>
<pre><code>
echo $app->execute('first-test');
</code></pre>
<p>Ever wonder what the second parameter of execute might be? We'll cover this on the next topic. <br>For now, we'll finish up the booting sequence by write a proper request dispatch.</p>
<h2>2. exedra dispatch</h2>
<p>This method currently just dispatch the http request onto the available application instance.</p>
<pre><code>
// echo $app->execute('first-test');
$exedra->dispatch();
</code></pre>
<h2>3. Booting Up</h2>
<p>Consider below as the full clean code for this topic.</p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);
$app = $exedra->build("App", function($app)
{
	// feel free to code here our outside.
});

$exedra->dispatch();

</code></pre>
<h2>4. Serve</h2>
<p>A simplest way to serve your project without setting up a uri rewrite, or configuring any server, is simply by using php built in server on your project directory (or wherever your index.php file is located).</p>
<pre><code>
php -S localhost:9000
</code></pre>
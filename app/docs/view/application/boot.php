<h1>Booting Exedra</h1>
<p>Exedra uses front-controller pattern, which acts as the main handler for every incoming request. For a simple booting up example, we'll use just <span class='label label-file'>index.php</span> as the main front-controller. But first, make sure you've already cloned exedra somewhere in your disk.</p>
<h2>1. Includes Exedra and build</h2>
<p>Require Exedra in your index.php (from wherever you put exedra), and boot your application up just like this : </p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";
</code></pre>
<p>Or use any convenient way like composer, for example.</p>
<pre><code>
require_once "../vendor/autoload.php";
</code></pre>
<p>Then, just initiate the core instance itself, Exedra. And create the application instance using <b>build</b> method.</p>
<pre><code>
$exedra = new \Exedra\Exedra(__DIR__);
$myapp = $exedra->build("App", function($app)
{
	// the main closure to do all sort of routing.
});

</code></pre>
<p>The <b>first argument</b> of exedra::build passed is supposed to be your application folder name (in this case 'app'). We'll <a href='<?php echo $exe->url->create('default', ['view'=>['application','components', 'application']]);?>'>cover this later</a>. <br>Okay, to test the application, we can <b>mock the application</b> without having to set up the .htaccess just yet. <br><br>
Write below code outside of the main closure, and <u>expect the simple thrown exception</u> because no routing has been done yet.</p>
<pre><code>
echo $myapp->execute(array('method' => 'GET', 'uri' => 'test'));
</code></pre>
<p>Then, let us write a simple routing, to fit the exact URI. Refresh the page, and expect the returned result.</p>
<pre><code>
$myapp = $exedra->build("App", function($app)
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
echo $myapp->execute('first-test');
</code></pre>
<p>Ever wonder what the second parameter of execute might be? We'll cover this on the next topic. <br>For now, we'll finish up the booting sequence by write a proper request dispatch.</p>
<h2>2. .htaccess and exedra dispatch</h2>
<p>A common thing most front-controller oriented framework do is, by using .htaccess to extract the <span class='label label-property'>path</span> from the request url. <br>This is my .htaccess :</p>
<pre><code>
RewriteEngine on

RewriteRule ^/? index.php [L]
Options -Indexes
</code></pre>
<p>After that, comment out the execute method, and do this instead. Dispatch.</p>
<pre><code>
// echo $myapp->execute('first-test');
$exedra->dispatch();
</code></pre>
<p>Our <b class='label label-class'>\Exedra\HTTP\Request</b> class basically extract uri path from <span class='label label-variable'>$_SERVER['REQUEST_URI']</span>.<br>The execute() method from the <span class='label label-variable'>$app</span> instance <b class='label label-class'>(\Exedra\Application\Application)</b> also takes the request instance, just to let you know.</p>

<h2>3. Booting Up</h2>
<p>Consider below as the full clean code for this topic.</p>
<pre><code>
require_once "../exedra/Exedra/Exedra.php";

$exedra = new \Exedra\Exedra(__DIR__);
$myapp = $exedra->build("App", function($app)
{
	// the main closure to do all sort of routing.
});

$exedra->dispatch();

</code></pre>
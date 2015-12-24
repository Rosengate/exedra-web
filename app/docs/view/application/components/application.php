<h1>Application <span>\Exedra\Application\Application</span></h1>
<p>The original application instance built by exedra. This is the instance where some core components are based on.</p>
<p>Most of below topics may have been introduced previously. We'll cover in detail here.</p>
<h2>1. Creating The Instance.</h2>
<p>Create your application instance with method <b class='label label-method'>\Exedra\Exedra::build()</b>. First argument is <span class='label bg-primary'>your application name</span> which will be the <span class='label bg-primary'>base directory</span> of where your application codes will be located (except public's, of course). In our examples, we just used <b>'App'</b> as the name.</p>
<pre><code>
$app = $exedra->build('App');
</code></pre>
<p>You may pass a <span class='label label-class'>\Closure</span> as second argument and expect an <span class='label label-class'>\Exedra\Exedra\Application</span> instance returned as the first parameter of the closure.</p>
<pre><code>
$app = $exedra->build('App', function(\Exedra\Application\Application $app)
{

});
</code></pre>
<h2>2. Core component</h2>
<p>Most of the core components are lazily injected into a <a href='<?php echo $exe->url->create('default', ['view' => 'others/dic']);?>'>DI container</a> by default, accessible as a public accessor on <span class='label label-variable'>$app</span> instance since we use a <a target='_blank' href='http://php.net/manual/en/language.oop5.overloading.php#object.get'>getter</a> for developer convenient.</p>
<div style="padding:10px; background: white;">
<?php $dependencies = array(
	'request' => 'HTTP Request referenced on this property for convenient use in application level.',
	'response' => 'HTTP Response referenced for convenient use in application level.',
	'map' => 'The main instance or general gateway for handling routes and levels.',
	'config' => 'A configuration instance with simple set, get, has functionality. May read dot notation based key.',
	'session' => 'The instance for handling user session. May read dot notation based key.',
	'exception' => 'Instance for handling exception on application level.',
	'path' => 'A path builder for convenient handling of path on application level.',
	'registry' => 'Handles execution registry, like middlewares'
	);
?>
	<table class='table'>
		<tr>
			<th>Name</th>
			<th>Description</th>
		</tr>
		<?php foreach($dependencies as $name => $description):?>
		<tr>
			<td><?php echo $name;?></td>
			<td><?php echo $description;?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>

<!-- <p>As seen in <b>\Exedra\Application\Application::__construct()</b></p>
<pre><code>
$this->di = new \Exedra\Application\Dic(array(
	"request"=>$this->exedra->httpRequest,
	"response"=>$this->exedra->httpResponse,
	// below are lazily loaded.
	"map"=> function() use($app) {return new \Exedra\Application\Map\Map($app);},
	"config"=> array("\Exedra\Application\Config"),
	"session"=> array("\Exedra\Application\Session\Session"),
	"exception"=> array("\Exedra\Application\Builder\Exception"),
	'file'=> array('\Exedra\Application\Builder\File', array($this))
	));
</code></pre> -->
<h2>3. (Re)register component</h2>
<p>You may later want to re-register the component. Just use the di container, and register the component by the same component's name again. Just make sure you extend the original class.</p>
<pre><code>
$app->container->register('config', array('\MyClasses\config'));
</code></pre>
<p>Or by array</p>
<pre><code>
$app->container->register(array(
	'event'=> array('\MyClasses\Event'),
	'cache'=> array('\MyClasses\Cache')
));

// you may then retrieve your own dependencies by 
$app->event;

// or 
$app->cache;
</code></pre>
<p>For more information, take a look at the container class</p>
<p>p/s : just make sure that the classes are available. If you're using composer, good. Else, use our autoloader, or your own.</p>
<h2>4. execute</h2>
<p>Execute application, by the given string of route name or an associative array of a query</p>
<h3>4.1. By route name</h3>
<pre><code>
$app->execute('public.user', ['username'=> 'eimihar']);
</code></pre>
<h3>4.2. By an associative array of query</h3>
<pre><code>
$app->execute(array(
	'method'=> 'get',
	'path'=> 'user/eimihar'
));
</code></pre>
<p>Most of the time, you don't usually use the second method unless for testing. The first method of execution, is good for executing another route.</p>
<p>Because the second method is usually executed by the original Exedra Dispatch method.</p>
<pre><code>
// dispatch request to the built application.
$exedra->dispatch();
</code></pre>
<h2>5. setFailRoute</h2>
<p>Set route to handle exception generally on application context.</p>
<pre><code>
$app->setFailRoute('error');
</code></pre>

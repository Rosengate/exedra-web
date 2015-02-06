<h1>Application</h1>
<p>The original application instance built by exedra. This is the instance where some core components are based on.</p>
<p>Most of below topics may have been introduced previously. We'll cover in detail here.</p>
<h2>1. Building The Instance.</h2>
<p>This instance are built by Exedra.</p>
<pre><code>
$myapp = $exedra->build('app');
</code></pre>
<p>You may pass a application closure as second argument while building the instance, which is recomended, to no taint your global namespace with anything.</p>
<p>The closure will give you the app instance as the first parameter.</p>
<pre><code>
$myapp = $exedra->build('app', function($app)
{
	// do your application thing.
});
</code></pre>
<h2>2. Core component</h2>
<p>Some of the core components are lazily injected on a DI container by default. Mean they're only instantiated once called.</p>
<pre><code>
$this->di = new \Exedra\Application\DI(array(
	"request"=>$this->exedra->httpRequest,
	"response"=>$this->exedra->httpResponse,
	// below are lazily loaded.
	"map"=> function() use($app) {return new \Exedra\Application\Map\Map($app);},
	"config"=> array("\Exedra\Application\Config"),
	"session"=> array("\Exedra\Application\Session\Session"),
	"exception"=> array("\Exedra\Application\Builder\Exception"),
	'file'=> array('\Exedra\Application\Builder\File', array($this))
	));
</code></pre>
<h2>3. Re-register component</h2>
<p>You may later want to re-register the component. Just use the di container, and register the component by the same component's name again. Just make sure you extends the original class.</p>
<pre><code>
$app->di->register('config', array('\MyClasses\config'));
</code></pre>
<p>Or by array</p>
<pre><code>
$app->di->register(array(
	'event'=> array('\MyClasses\EventObserver'),
	'cache'=> array('\MyClasses\CacheManager')
));

// you may then retrieve your own dependencies by 
$app->event;

// or 
$app->cache;
</code></pre>
<p>For more information, take a look at DI class</p>
<p>p/s : just make sure that the classes are available. If you're using composer, good. Else, use our autoloader, or your own.</p>
<h2>4. execute</h2>
<p>Execute application, by the given string of route name or an associative array of a query</p>
<p>By route name</p>
<pre><code>
$app->execute('public.user', ['username'=> 'eimihar']);
</code></pre>
<p>By an associative array of query</p>
<pre><code>
$app->execute(array(
	'uri'=> 'user/eimihar',
	'method'=> 'get'
));
</code></pre>
<p>Most of the time, you don't usually use the second method. The first method of execution, is good for executing another route.</p>
<p>For the second method is usually executed by the original Exedra Dispatch method.</p>
<pre><code>
// dispatch request to the built application.
$exedra->dispatch();
</code></pre>
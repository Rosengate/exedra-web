<h1>Http Message</h1>
<p>The core and fundemental of web development.</p>
<h2>Http Request</h2>
<p>In exedra, it plays a role in routing dispatch, especially a request URI and method.</p>
<p>This instance initially available as a service on application context itself, created from global server variable.</p>
<pre><code>
$app = new \Exedra\Application(__DIR__);

$request = $app->request; // not recommended, container resolve on service call.
</code></pre>
<p>It's not recommended to invoke call request on application context, due to the nature that it's also shared with non-request context, such as console/wizard.</p>
<h3>Rewriting</h3>
<p>But there might be time that you want to rewrite the URI internally, without entering the runtime yet. It's suggested that it's done on our http facing front-controller, such as in <span class='label label-file'>/public/index.php</span></p>
<pre><span class='code-tag label label-file'>/public/index.php</span><code>
$app = require_once __DIR__.'/app.php'; // if it's located there.

$uri = $app->request->getUri();

$app->request->getUri()->setPath(str_replace('/test-path', '', $uri->getPath()));

$app->dispatch();
</code></pre>
<h3>Re-register</h3>
<p>If you needed to register it around our application codes, it's best to do so as a registry.</p>
<pre><code>
$app['service']->set('request', function()
{
	$request = new \Exedra\Http\ServerRequest::createFromGlobals();

	//.. do things here

	return $request;
});
</code></pre>
<h3>Runtime</h3>
<p>This http request is also indirectly accessible on runtime level, depending on which instance was dispatched.</p>
<p>For example, if you dispatched different type of request:</p>
<pre><code>
$app->dispatch(\App\Http\MyServerRequest::createFromGlobals());
</code></pre>
<p>On runtime level,</p>
<pre><code>
$app->map->any('/')->execute(function($exe)
{
	echo get_class($exe->request); // yields \App\Http\MyServerRequest
});
</code></pre>
<p>As long as it inherits from the original <span class='label label-class'>\Exedra\Http\ServerRequest</span></p>
<h3>Operations</h3>
<p>There're number of methods on request instance, having most of them follow the Psr7 Http Message specification.</p>
<h4><span class='h-type'>String</span> getMethod</h4>
<p>Get get request method</p>
<pre><code>
$method = $exe->request->getMethod();
</code></pre>
<h4><span class='h-type'>\Exedra\Http\Uri</span> getUri</h4>
<p>Get uri instance for the request</p>
<pre><code>
$uri = $exe->request->getUri();
</code></pre>
<h4><span class='h-type'>Array</span> getServerParams</h4>
<p>Get $_SERVER variable</p>
<pre><code>
$server = $exe->request->getServerParams();
</code></pre>
<h4><span class='h-type'>Array</span> getCookieParams</h4>
<p>Get $_COOKIE variable</p>
<pre><code>
$cookie = $exe->request->getCookieParams();
</code></pre>

<h1>Execution <span>\Exedra\Application\Execution\.</span></h1>
<p>One of the main important layer for your application. The execution layer. Basically this is where a route has successfully been executed, and it's the moment you decide what you're going to do next.</p>
<p>Like what have been mentioned earlier, you're given the instance of <b>\Exedra\Application\Execution\Exec</b> ($exe) on the execution handler. This instance is relatively tied to few things such as routePrefix or the configured sub-application on the outer layer. (routing)</p>
<p>This instance also has a <a href='<?php echo $exe->url->create('default', ['view'=>['others','dic']]);?>'>dependendeny injection container</a>, that hold a lot of useful dependencies for your application, such as session, validator, form helper (form), and etc.</p>
<h2>1. Example</h2>
<p><b>Let's begin with example and a sneak peak of other components :</b></p>
<pre><code>
$app->map->addRoutes(array(
	'testroute'=> ['uri'=> 'testuri', 'execute'=> function($exe)
	{
		// here. is basically the layer of execution. example : 
		// create url 
		$url = $exe->url->create('otherroute', ['username'=> 'eimihar']);

		// set session
		$exe->session->set('user', 'eimihar');

		// redirect
		return $exe->redirect->to('otherroute', ['username'=>'kiko']);
	}],
	'otherroute'=>['uri'=> 'user/[:username]/', 'execute'=> function(){ }]
));
</code></pre>
<h2>2. Route Prefix</h2>
<p>Route prefix is best configured within a middleware on some route node. It basically let you bases your route on a fixed route name (prefix), and anything further down the route would simply be prefixed.</p>
<pre><code>
$exe->setRoutePrefix('example.route');
</code></pre>
<p>List of components affected by this route prefixing is :</p>
<ol>
	<li>Url</li>
	<li>Redirection</li>
</ol>
<h2>3. execute()</h2>
<p>Like what've been mentioned in the previous topic (re-routing), this method is basically an alias to method <b>application::execute()</b>, except, it was bound relatively to the current execution context, if it was used by the instance.</p>
<p><b>First parameter : Route name : </b><br>
This route name is relatively tied to the current route prefix, if the method was called by the exec instance. But, can still be escaped with the absolute character <b>'@'</b>.
</p>
<p>For example : </p>
<pre><code>
// unescaped (bound to the current route prefix)
$exe->execute('main.index');

// escaped (absoute route name)
$exe->execute('@public.main.index');
</code></pre>
<p><b>Second parameter : Route parameters</b><br>
Is an argument/data to be passed to the specified route execution context. That later can be retrieved by method param(). Example can be shown on the next subtopic. [<b>param()</b>]
</p>
<h2>4. param()</h2>
<p>This method return the passed argument, either by URI named parameter(s), or passed as the second argument of execute() method.</p>
<pre><code>
$app->map->addRoutes(array(
	'first'=> ['uri'=> 'test/[:myparam]', 'execute'=> function($exe)
	{
		// forward this named parameter to the other route.
		return $exe->execute('second', ['same-param'=> $exe->param('myparam')]);
	}],
	'second'=> ['uri'=>false, 'execute'=> function($exe)
	{
		// retrieve 
		return 'My passed parameter is :'. $exe->param('same-param');
	}]
));
</code></pre>
<h2>5. Registered dependencies</h2>
<p>This execution instance basically already has a dependency injection container built along, that at the framework runtime it has registered number of useful components for application development.</p>
<h3>5.1 List of registered dependencies that could be useful for your application :</h3>
<label>Builders (factories of classes):</label>
<ul>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'builders', 'controller']]);?>'>Controller</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'builders', 'view']]);?>'>View</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['']]);?>'>Model</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components', 'url']]);?>'>Url</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'builders', 'middleware']]);?>'>Middleware</a></li>
</ul>
<label>Components :</label>
<ul>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components','session']]);?>'>Session</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components','flash']]);?>'>Flash</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components','validator']]);?>'>Validator</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components','form']]);?>'>Form</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view'=>['execution', 'components','redirection']]);?>'>Redirect</a></li>
</ul>
<h3>5.2 (Re)register dependency</h3>
<p>Similar to application instance, you may also re-register your dependency through the given DI container.</p>
<p>Below is some original code as seen in <b>\Exedra\Application\Execution\Exec::__construct()</b></p>
<pre><code>
$this->di = new \Exedra\Application\Dic(array(
	"loader"=> array("\Exedra\Loader", array($app->getAppName().'/'.$subapp, $this->app->structure)),
	"controller"=> array("\Exedra\Application\Builder\Controller", array($this)),
	"view"=> array("\Exedra\Application\Builder\View", array($this)),
	"middleware"=> array("\Exedra\Application\Builder\Middleware", array($this)),
	"url"=> array("\Exedra\Application\Builder\Url", array($this->app,$this)),
	"request"=>$this->app->request,
	"response"=>$this->app->exedra->httpResponse,
	"validator"=> array("\Exedra\Application\Utilities\Validator"),
	"flash"=> function() use($app) {return new \Exedra\Application\Session\Flash($app->session);},
	"redirect"=> array("\Exedra\Application\Response\Redirect", array($this)),
	"exception"=> array("\Exedra\Application\Builder\Exception", array($this)),
	"form"=> array("\Exedra\Application\Utilities\Form", array($this)),
	"session"=> function() use($app) {return $app->session;},
	"file"=> array("\Exedra\Application\Builder\File", array($app, $this->subapp))
	));
</code></pre>
<p>To re-register and use your own instead, just do similarly like this through $exe instance.</p>
<pre><code>
$exe->di->register(array(
	'validator'=> array('\MyClasses\Validator'),
	'form'=> array('\MyClasses\Form', array($exe))
));
</code></pre>
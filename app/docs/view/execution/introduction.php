<h1>Execution <span>\Exedra\Application\Execution\.</span></h1>
<p>One of the main important layer for your application. The execution layer/context. An <span class='label label-class'>\Exedra\Application\Execution\Exec</span> instance is returned when a route has been successfully executed, and handled by a matched <a href='<?php echo $exe->url->create('default', ['view' => 'execution/handlers']);?>'>handler</a>.</p>
<p>This instance basically serve as a context or container of your execution. It also has a <a href='<?php echo $exe->url->create('default', ['view'=>['others','dic']]);?>'>dependency injection container</a>, that hold a lot of useful dependencies for your application, such as session, form helper (form), and etc.</p>
<h2>1. Example</h2>
<p><b>Let's begin with example and a sneak peak of other components :</b></p>
<pre><code>
$app->map->addRoutes(array(
	'testroute'=> ['path'=> 'testpath', 'execute'=> function($exe)
	{
		// here. is basically the layer of execution. example : 
		// create url 
		$url = $exe->url->create('otherroute', ['username'=> 'eimihar']);

		// set session
		$exe->session->set('user', 'eimihar');

		// redirect
		return $exe->redirect->to('otherroute', ['username'=>'kiko']);
	}],
	'otherroute'=>['path'=> 'user/[:username]/', 'execute'=> function(){ }]
));
</code></pre>
<h2>2. Base Route</h2>
<p>Base route can be configured either by <span class='label label-variable'>$exe</span> instance, or through routing. It basically let you base your route on a fixed route name (prefix), and certain functionality happened further down the route would simply be prefixed.</p>
<pre><code>
$exe->setBaseRoute('example.route');
</code></pre>
<p>By route <span class='label label-property'>base</span> property</p>
<pre><code>
$app->map->addRoutes(array(
	'book' => array(
		'path' => '/hello',
		'base' => true
	)
));
</code></pre>
<p>A boolean true <span class='label label-property'>base</span> property will be evaluated as the current route name. Anything deep down the route will use this base instead.</p>
<h5>Affected components</h5>
<p>List of components affected by this route prefixing is :</p>
<ol>
	<li>Url</li>
	<li>Redirection</li>
	<li><span>Exec</span></li>
</ol>
<p>An execution without base route configured will be prefixed with the parent route of the current route.</p>
<h2>3. execute()</h2>
<p>Like what've been mentioned in the previous topic (re-routing), this method is basically an alias to method <b>application::execute()</b>, except, it was bound relatively to the current execution context, if it was used by the instance.</p>
<p><b>First argument : Route name</b><br>
Through <span class='label label-class'>Exec</span> instance, this route name is relatively bound to the current base route. But, can still be escaped with the absolute character <b class='label label-string'>@</b>.
</p>
<p>For example : </p>
<pre><code>
// unescaped (bound to the current base route)
$exe->execute('main.index');

// escaped (absoute route name)
$exe->execute('@public.main.index');
</code></pre>
<p><b>Second parameter : Route parameters</b><br>
Is an argument/data to be passed to the specified route execution context, that later can be retrieved by method param(). <br>For a route with named parameter(s) on it's path, an exception will be thrown if no parameter with the same name passed. Example can be shown on the next subtopic.
</p>
<h2>4. param()</h2>
<p>This method return the passed argument, either by URI path named parameter(s), or passed as the second argument of execute() method.</p>
<pre><code>
$app->map->addRoutes(array(
	'first'=> ['path'=> 'test/[:myparam]', 'execute'=> function($exe)
	{
		// forward this named parameter to the other route.
		return $exe->execute('second', ['same-param'=> $exe->param('myparam')]);
	}],
	'second'=> ['path'=>false, 'execute'=> function($exe)
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
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/builders/controller']);?>'>Controller</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/builders/view']);?>'>View</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/builders/model']);?>'>Model</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/url']);?>'>Url</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/builders/middleware']);?>'>Middleware</a> <span style='color: red'>?</span></li>
</ul>
<label>Components :</label>
<ul>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/session']);?>'>Session</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/flash']);?>'>Flash</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/validator']);?>'>Validator</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/form']);?>'>Form</a></li>
	<li><a href='<?php echo $exe->url->create('default', ['view' => 'execution/components/redirection']);?>'>Redirect</a></li>
</ul>
<h3>5.2 (Re)register dependency</h3>
<p>Similar to application instance, you may also re-register your dependency through the given DI container.</p>
<p>Below is some original code as seen in <b class='label label-method'>\Exedra\Application\Execution\Exec::initiateContainer()</b></p>
<pre><code>
$this->container = new \Exedra\Application\Container(array(
	"controller"=> array("\Exedra\Application\Builder\Controller", array($this)),
	// "view"=> array("\Exedra\Application\Builder\View", array($this->exception, $this->loader)),
	"view" => function() use($exe) {return new \Exedra\Application\Builder\View($exe->exception, $exe->loader);},
	"middleware"=> array("\Exedra\Application\Builder\Middleware", array($this)),
	"url"=> array("\Exedra\Application\Execution\Builder\Url", array($this)),
	"request"=>$this->finding->request ? : $this->app->request, // use finding based request if found, else, use the original http request one.
	"response"=>$this->app->exedra->httpResponse,
	"validator"=> array("\Exedra\Application\Utilities\Validator"),
	"flash"=> function() use($app) {return new \Exedra\Application\Session\Flash($app->session);},
	"redirect"=> array("\Exedra\Application\Response\Redirect", array($this)),
	"exception"=> array("\Exedra\Application\Execution\Builder\Exception", array($this)),
	"form"=> array("\Exedra\Application\Execution\Builder\Form", array($this)),
	"session"=> function() use($app) {return $app->session;},
	// "file"=> function() use($exe) {return new \Exedra\Application\Builder\File($exe->loader);},
	'middlewares'=> array('\Exedra\Application\Execution\Middlewares'),
	'asset' => array('\Exedra\Application\Builder\Asset', array($this)),
	'path' => array('\Exedra\Application\Builder\Path', array($this->loader))
	));
</code></pre>
<p>To re-register and use your own instead, just do similarly like this through <span class='label label-variable'>$exe</span> instance.</p>
<pre><code>
$exe->container->register(array(
	'validator'=> array('\MyClasses\Validator'),
	'form'=> array('\MyClasses\Form', array($exe))
));
</code></pre>
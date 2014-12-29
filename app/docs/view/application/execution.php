<h1>Execution</h1>
<p>One of the main important layer for your application. The execution layer. Basically this is where a route has successfully been executed, and it's the moment you decide what you're going to do next.</p>
<p>Like what have been mentioned earlier, you're given the instance of <b>\Exedra\Application\Execution\Exec</b> on the execution handler. This instance is relatively tied to few things such as routePrefix or the configured sub-application on the outer layer. (routing)</p>
<p>This instance also has a dependendeny injection container, that hold a lot of useful components, such as session, validator, form helper (form), and etc. Which mean, yeah, non of the components are instanced unless called, exedra use getter for this.</p>
<h2>1. Example</h2>
<p><b>Let's begin with example and a sneak peak of other components :</b></p>
<pre><code>
$app->map->addRoute(array(
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
<p>Route prefix is best configured within a middleware on some route node. It basically let you base your route on a fixed route (prefix). The ultimate benefit is, lessen the concern of writing the full absolute route, be more modular of your own application.</p>
<pre><code>
$exe->setRoutePrefix('example.route');
</code></pre>
<p>List of components affected by this route prefixing is :<br>
1. URL<br>
2. Redirection
</p>
<h2>3. execute()</h2>
<p>Like what've been mentioned in the previous topic (re-routing), this method is basically an alias to method application::execute(), except, it was bound relatively to the current execution context, if it was used by the instance.</p>
<p><b>First parameter : Route name : </b><br>
This route name is relatively tied to the current route prefix, if the method was called by the exec instance. But, can still be escaped with character '@'
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
<p>This method return the value argument passed, either through named parameter on URI, or the second parameter of execute() method.</p>
<pre><code>
$app->map->addRoute(array(
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
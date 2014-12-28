<h1>Execution</h1>
<p>One of the main important layer for your application. The execution layer. Basically this is where a route has successfully been executed, and it's the moment you decide what you're going to do next.</p>
<p>Like what have been mentioned earlier, you're given the instance of \Exedra\Application\Execution\Exec on the execution handler. This instance is relatively tied to few things such as routePrefix or the configured sub-application on the outer layer. (routing)</p>
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
<h1>Controller <span>\Exedra\Application\Builder\Controller</span></h1>
<p>One of the main component in MVC oriented architecture. You may actually code everything in routing, but having a planned controllers will surely structure your codes well.</p>
<h2>1. Create a controller</h2>
<p>You may retrieve the builder from $exe instance.</p>
<pre><code>
$app->map->addRoute(array(
	'profile'=>['uri'=> 'user/[:userID]', 'execute'=> function($exe)
	{
		return $exe->controller->execute('user', 'profile', [$exe->param['userID']]);
	}]
));
</code></pre>
<p>And it will look for the class called 'ControllerUser' inside file app/controller/user.php</p>
<pre><code>
// app/controller/user.php
class ControllerUser
{
	// you may retrieve the $exe instance within the constructor.
	public function __construct($exe)
	{
		$this->exe = $exe;
	}
	public function profile()
	{

	}
}

</code></pre>
<h2>2. Create a default controller's route</h2>
<p>The common controller/action/p1/p2/p3 routing.</p>
<pre><code>
$app->map->addRoute(array(
	'default'=>['uri'=> '[:controller]/[**:action]', 'execute'=> function($exe)
	{
		return $exe->controller->execute($exe->param('controller'), $exe->param('action'));
	}]
));
</code></pre>
<h2>3. By String</h2>
<p>Specify the string of class@method</p>
<pre><code>
$app->map->addRoute(array(
	'profile'=>['uri'=> 'user/[:userID]', 'execute'=> 'controller=user@profile']
));
</code></pre>
<p>Or <b>mention the parameter</b> in the string.</p>
<pre><code>
$app->map->addRoute(array(
	'default'=> ['uri'=> '[:controller]/[**:action]', 'execute'=> 'controller={controller}@{action}']
));
</code></pre> 

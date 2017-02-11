<h1>Controller <span>\Exedra\Factory\Controller</span></h1>
<p>A simple factory to help with the creation of controller. You may actually code everything in routing, but having a planned controllers may structure your codes well.</p>
<h2>Executing a controller</h2>
<p>The factory is retrievable as a service from <span class='label label-class'>\Exedra\Runtime\Exe</span> instance.</p>
<pre><code>
$app->map->get('/user/:userId')->execute(function($exe)
{
	return $exe->controller->execute('User', 'profile', [$exe->param['userID']]);
});
</code></pre>
<p>And it will look for the class called <strong>\App\Controller\User</strong> (namespaced) inside file app/Controller/User.php</p>
<pre><code>
// App/Controller/User.php
namespace App\Controller;

class User
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
<p>In Exedra, a lot of things are gonna be execution oriented component, such as controller built using this factory. As what is seen above, your constructor is gonna be injected with the $exe instance.</p>
<pre><code>
public function __construct(\Exedra\Application\Execution\Exec $exe)
{
	$this->exe = $exe;
}
</code></pre>
<h2>Create a default controller's route</h2>
<p>The typical controller/action/* routing.</p>
<pre><code>
$app->map->addRoutes(array(
	'default'=>['path' => '/:controller/*:action', 'execute'=> function($exe)
	{
		return $exe->controller->execute($exe->param('controller'), $exe->param('action'));
	}]
));
</code></pre>
<h2>Through a Handler pattern</h2>
<p>Specify by the execution handler for controller</p>
<pre><code>
$app->map->addRoutes(array(
	'profile'=>['path' => '/user/:userID', 'execute'=> 'controller=User@profile']
));
</code></pre>
<p><b>mention the route parameter</b> in the string.</p>
<pre><code>
$app->map->addRoutes(array(
	'default'=> ['path' => '/:controller/*:action', 'execute'=> 'controller={controller}@{action}']
));
</code></pre> 

<h1>Handlers</h1>
<p>Each time an application is about to get executed, it will look for the execution handler specified on the executing route.</p>
<pre><code>
// use of intermediate variable as a sample.
$handler = function($exe){ };

$app->map->get('/book')->execute($handler);
</code></pre>
<p>The <span class='label label-method'>\Exedra\Routing\Route::execute()</span> method takes a mixed type of handler as the only argument. It can be a \Closure, a string or anything because it's handled by the runtime registry.</p>
<p>However there're currently to two kind of handlers registered internally.</p>
<h2>Registered handlers</h2>
<h3>1. Closure</h3>
<p>Commonly used way of writing your code.</p>
<pre><code>
$app->map->get('/about-us')->execute(function($exe) {

});
</code></pre>
<h3>2. String based controller</h3>
<p>A string based controller execution. Sometime you just need a simpler way of specifying the controller.</p>
<pre><code>
// default routing.
$app->map->addRoutes(array(
	'author' => array(
		'path' => '/authors/[:action]',
		'execute' => 'controller=Author@{action}'
	)
));
</code></pre>
<h2>Registering your own handler</h2>
<p>And sometime you need a very custom tailored string based handler, and exedra couldn't provide you that except on your own terms. It's encouraged to write your own handler.</p>
<h3>Handler registry</h3>
<p>Register your handler through the runtime registry service.</p>
<pre><code>
$app->runtime->addHandler('viewHandler', '\App\Runtime\FooBarHandler');
</code></pre>
<p>Then code the handler which extends <span class='label label-class'>\Exedra\Runtime\Handler\HandlerAbstract</span>, or implement the handler interface <span class='label label-class'>\Exedra\Runtime\Handler\HandlerInterface</span>.</p>
<pre><code>
&ltphp;
namespace App\Runtime;

class FooBarHandler implements \Exedra\Runtime\Handler\HandlerInterface
{
	public function __construct($name, \Exedra\Runtime\Exe $exe)
	{
		$this->name = $name;

		$this->exe = $exe;
	}

	public function validate($handler)
	{
		//.. validate handler pattern. and return a boolean.
	}

	public function resolve($handler)
	{
		//.. resolve the handler pattern, and MUST return a closure.
	}
}
</code></pre>
<h3>validate($handler)</h3>
<p>This method receives the specified handler pattern, and MUST return a boolean. Return a true if you need it to be matched.</p>
<p>For example :</p>
<pre><code>
//..
public function validate($handler)
{
	if(is_string($handler) && strpos($handler, 'view=') === 0)
		return true;

	return false;
}
//..
</code></pre>
<h3>resolve($handler)</h3>
<p>If the handler <b>validate</b> method returns true, it will user the resolve using the handler's. This method receives the same specified handler pattern. And it MUST return a \Closure.</p>
<pre><code>
//..
public function resolve($handler)
{
	return function($exe) use($handler) {
		$view = substr($handler, 5); // remove 'view='

		return $exe->view->create($view)->render();
	}
};
</code></pre>
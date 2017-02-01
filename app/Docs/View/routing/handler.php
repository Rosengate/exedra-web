<h1>Handlers</h1>
<p>Each time an application is about to get executed, it will look for the execution handle specified on the executing route.</p>
<pre><code>
// use of intermediate variable as a sample.
$handle = function($exe){ };

$app->map->get('/book')->execute($handle);
</code></pre>
<p>The <span class='label label-method'>\Exedra\Routing\Route::execute()</span> method takes a mixed type of handler as the only argument. It can be a \Closure, a string or anything.</p>
<p>However there're currently to two kind of handlers registered initially.</p>
<h2>Registered handlers</h2>
<h3>1. Closure</h3>
<p>Commonly used way of writing your code.</p>
<pre><code>
$app->map->get('/about-us')->execute(function($exe) {
	//.. some code
});
</code></pre>
<h3>2. String based controller</h3>
<p>A string based controller handle. Sometime you just need a simpler way of specifying the controller.</p>
<pre><code>
$app->map['author']->path('/authors/[:action]')->execute('controller=Author@{action}');
</code></pre>
<h2>Registering your own handler</h2>
<h5>Exedra\Routing\Group::handler(<em>string</em> $handler, <em>string</em> $className)</h5>
<p>And sometime you need a very custom tailored string based handler, and exedra couldn't provide you that except on your own terms. It's encouraged to write your own handler. But the cool thing about writing an handler is, it's registered on routing group, and you can have a different sets of handlers on different sets of routing, all tailorable to the context of your application.</p>
<h3>Handler registry</h3>
<p>Register a definite handler by a class name.</p>
<pre><code>
$app->map->handler('viewHandler', '\MyApp\Runtime\ViewHandler');
</code></pre>
<p>Then code the handler which extends <span class='label label-class'>\Exedra\Runtime\Handler\HandlerAbstract</span>, or implement the handler interface <span class='label label-class'>\Exedra\Runtime\Handler\HandlerInterface</span>.</p>
<pre><code>
&ltphp;
namespace MyApp\Runtime;

class FooBarHandler implements \Exedra\Runtime\Handler\HandlerInterface
{
	public function __construct(\Exedra\Runtime\Exe $exe)
	{
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
<h4>validate($handler)</h4>
<p>This method receives the specified handler pattern, and <b>MUST</b> return a boolean. Return a true if you need it to be matched.</p>
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
<h4>resolve($handler)</h4>
<p>The handler will resolve on true condition returned on validate method, and this method <b>MUST</b> return a \Closure.</p>
<pre><code>
//.. example
public function resolve($handler)
{
	return function($exe) use($handler) {
		$view = substr($handler, 5); // remove 'view='

		return $exe->view->create($view)->render();
	}
};
</code></pre>
<p>Executing the handler</p>
<pre><code>
$app->map->get('/about-us')->execute('view=about-us');
</code></pre>
<h3>Anonymous Handler</h3>
<p>For some who would prefer much functional approach. It's possible to code an handler anonymously while passing a <span class='label label-type'>\Closure</span> as the second argument. The closure will receive a <span class='label label-class'>\Exedra\Runtime\Handler\Handler</span>, a generic handler with two listener methods, <span class='label label-method'>onValidate(\Closure $callback)</span> and <span class='label label-method'>onResolve(\Closure $callback)</span>.</p>
<pre><code>
$app->map->any('/')->group(function($group)
{
	$group->handler('restful', function($handler)
	{
		$handler->onValidate(function($pattern)
		{

		});

		$handler->onResolve(function($pattern)
		{

		});
	});
});
</code></pre>

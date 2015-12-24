<h1>Instances</h1>
<p>Exedra uses no static when dealing with codes. It's really up to the developer themselves to implement a facade pattern, singleton, multiton any simplifying kind of pattern. But here, your codes will live in <b>at most three contexts.</b></p>
<p>On the upcoming topics, you will hear a lot about these instances such as <span class='label label-variable'>$exedra</span>, <span class='label label-variable'>$app</span>, and <span class='label label-variable'>$exe</span>. So, we feel like it's important to foremost mention them here a little.</p>
<h2>1. Exedra</h2>
<p><span class='label label-class'>\Exedra\Exedra</span></p>
<p>The original instance of Exedra. One and the only one instantiated by you.</p>
<pre><code>
$exedra = new \Exedra\Exedra(__DIR__);
</code></pre>
<h2>2. Application</h2>
<p><span class='label label-class'>\Exedra\Application\Application</span></p>
<p>The application instance you build through method <span class='label label-method'>Exedra\Exedra::build()</span>. Read more about the instance <a href='<?php echo $exe->url->create('default', ['view'=> 'application/components/application']);?>'>here</a>.</p>
<pre><code>
$app = $exedra->build('Myapp', function(\Exedra\Application\Application $app) {

});
</code></pre>
<p>Or you may later get it from exedra itself.</p>
<pre><code>
$myapp = $exedra->get('Myapp');
</code></pre>
<h2>3. Exec</h2>
<p><span class='label label-class'>\Exedra\Application\Execution\Exec</span></p>
<p>The original execution instance, which we rather keep it short to Exec, and call it <span class='label label-variable'>$exe</span>. This instance is retrievable through whatever handler is handling it. This instance hold a lot of useful functionality injected for your application. Such as builders, and utilities, and you may also retrieve the execution arguments, like uri path parameters, and etc. You can read more <a href='<?php echo $exe->url->create('default', ['view'=> 'execution/introduction']);?>'>here</a>.</p>
<pre><code>
$app->map->addRoutes(array(
	'user'=> array('path'=> 'user/[:user-name]', 'execute'=> function($exe)
	{
		return $exe->param('user-name');
	})
));
</code></pre>
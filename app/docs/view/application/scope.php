<h1>Instances</h1>
<p>We uses no static when dealing with codes. But they live in three instances layer.</p>
<p>On the upcoming topics, you will hear a lot about these instances such as <b title='\Exedra\Exedra'>$exedra</b>, <b title='\Exedra\Application\Application'>$app</b>, and <b title="\Exedra\Application\Execution\Exec">$exe</b>. So, we feel like it's important to foremost mention them here.</p>
<h2>1. Exedra</h2>
<p style="font-size:0.9em;">\Exedra\Exedra</p>
<p>The original instance of Exedra. The one you created.</p>
<pre><code>
$exedra = new \Exedra\Exedra(__DIR__);
</code></pre>
<h2>2. Application</h2>
<p style="font-size:0.9em;">\Exedra\Application\Application</p>
<p>The application instance you build by exedra. Retrievable by the original closure, or the one returned by the method Exedra\Exedra::build(). Read more about the instance at <a href='<?php echo $exe->url->create('default', ['view'=> array('application', 'components', 'application')]);?>'>here</a>.</p>
<pre><code>
$app = $exedra->build('myapp', function($app)
{

});
</code></pre>
<p>Or you may later get it from exedra itself.</p>
<pre><code>
$myapp = $exedra->get('myapp');
</code></pre>
<h2>3. Exec</h2>
<p style="font-size:0.9em;">\Exedra\Application\Execution\Exec</p>
<p>The original execution instance, which we rather keep it short to Exec, and called it <b>$exe</b>. This instance is retrieved from within the route execution closure. This instance held a lot of useful functionality injected for your application. Such as builders, and utilities, and you may also retrieve the execution arguments, like uri parameters, and etc. You can read more <a href='<?php echo $exe->url->create('default', ['view'=> array('execution', 'introduction')]);?>'>here</a>.</p>
<pre><code>
$app->map->addRoute(array(
	'myroute'=> array('uri'=> 'myroute/[:myname]', 'execute'=> function($exe)
	{
		return $exe->param('myname');
	})
));
</code></pre>
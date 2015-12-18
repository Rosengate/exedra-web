<h1>Handlers <span>\Exedra\Application\Execution\Handlers</span></h1>
<p>This component deals with the <span class='label label-property'>execute/handler</span> property pattern specified in your routing, which is executed on successful finding and execution.</p>
<p>There're currently only 2 default handlers registered, that it's encouraged that you can imagine, write and design your own handler!.</p>
<h2>1. \Closure</h2>
<p>You may've noticed, that we frequently use <span class='label label-class'>\Closure</span> previously, especially on certain topic related to routing.</p>
<pre><code>
$app->map->addRoutes(array(
	'books' => array(
		'uri' => '/books',
		'execute' => function($exe)
		{

		}
	)
));

// or using convenient routing
$app->map->get('/faq', function($exe)
{

});
</code></pre>
<h2>2. controller</h2>
<p>A string based handler pattern to route your successful execution to it's desired Controller. You can however write your own controller handler, if you want.</p>
<pre><code>
$app->map->addRoutes(array(
	'author' => array(
		'uri' => '/authors/[:action]',
		'execute' => 'controller=Author@{action}'
	)
));
</code></pre>
<p>This example handler <span class='label label-string'>controller=Author@{action}</span> does exactly like what below is doing.</p>
<pre><code>
$app->map->addRoutes(array(
	'author' => array(
		'uri' => '/authors/[:action]',
		'execute' => function($exe)
		{
			return $exe->controller->execute('Author', $exe->param('action'));
		}
	)
));
</code></pre>
<p>Check them out at <span class='label label-dir'>Exedra/Application/Execution/Handlers/</span> about how they work.</p>
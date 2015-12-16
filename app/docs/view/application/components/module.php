<h1>Module</h1>
<p>Modularizing you application is just as simple as just defining a parameter <b>module</b> on a route. This feature basically modularize only components like <b>controllers</b> and <b>views</b> into a folder named by the defined module.</p>
<h2>1. Defining module name</h2>
<p>You may define it in a route definition, similarly like what we've mentioned previously in routing topic.</p>
<pre><code>
$app->map->addRoutes(array(
	'frontend' => array(
		'uri' => '/',
		'module' => 'frontend'
		)
));
</code></pre>
<p>Your folder structure may become like this :</p>
<pre><span class='code-tag label label-dir'>/</span><code>
App
  Frontend
    Controller
    View
</pre></code>
<p>The module will be applied to that route and those nested under it.</p>
<pre><code>
$app->map->addRoutes(array(
	'frontend' => array(
		'uri' => '/',
		'module' => 'frontend',
		'subroutes' => array(
			'blog' => array(
				'uri' => 'blog',
				'execute' => 'controller=blog@index' // it will look for \app\frontend\controller\blog.php
				)
			)
		)
));
</code></pre>
<h2>2. Controller</h2>
<p>Your controller will be namespaced under the module name. Use the example from previous codes.</p>
<pre><code>
namespace App\Frontend\Controller;

class Blog
{
	public function __construct($exe)
	{

	}
}
</code></pre>
<h2>3. View</h2>
<p>View will also be affected by the defined module.</p>
<p>Writing this within the modulized execution, will look for <b>\app\frontend\view\foo\bar.php</b></p>
<pre><code>
$exe->view->create('foo/bar');
</code></pre>

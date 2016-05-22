<h1>View <span>\Exedra\Factory\View</span></h1>
<p>A simple View factory to help on templating, design your view logic, required data, and even build a layout dan can contain a view.</p>
<h2>Create a view</h2>
<pre><code>
$app->map->addRoutes(array(
	'profile'=> ['path'=> 'user/[:username]', 'execute'=> function($exe)
	{
		$view = $exe->view->create("user/profile");

		return $view->render();
	}]
));
</code></pre>
<p>Then it may search for a file with path <span class='label label-file'>app/View/user/profile.php</span></p>
<h2>Passing a data</h2>
<p>Example of passing a data</p>
<pre><code>
// within the execution handler.
$view = $exe->view->create("user/profile");

$view->set('title', "User Profile");
</code></pre>
<p>Or by array</p>
<pre><code>
	
$view->set([
	"username" => "eimihar",
	"age"=> 26,
	"email"=> "newrehmi@gmail.com"
]);

return $view->render();
</code></pre>
<p>Then you may use the passed data in the form of variable.</p>
<pre><span class='code-tag label label-file'>app/View/user/profile.php</span><code>
title : &lt;php? echo $title;?&gt; 
name : &lt;php? echo $username;?&gt;
age : &lt;php? echo $age;?&gt;
email : &lt;php? echo $email;?&gt;
</code></pre>
<h2>Required Data</h2>
<p>Defining a required data sets a contract about what your view needed before it can render.</p>
<pre><code>
$view = $exe->view->create("user/profile");

$view->setRequiredData(['title','description', 'image']);
</code></pre>
<h2>Building up a layout</h2>
<p>There's no difference in creating a layout, than simply creating a view and render another view within it.</p>
<pre><code>
// you may use the $exe instance, and store the variable layout for later user, like in controller.
$exe->layout = $exe->view->create('layout/default')->setRequired(['view']);
</code></pre>
<pre><code>
// in the place to render the layout
$exe->layout->set('view', $exe->view->create('user/profile'))->render();
</code></pre>
<pre><span class='code-tag label label-file'>app/View/layout/default.php</span><code>
&lt;html&gt;
	&lt;head&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;php? echo $view->render();?&gt; 
	&lt;/body&gt;
&lt;/html&gt;
</code></pre>
<pre><span class='code-tag label label-file'>app/View/user/profile.php</span><code>
&lt;div class="container"&gt;
Hello world!!!!
&lt;/div&gt;
</code></pre>
<p>The rendered result :</p>
<pre><span class='code-tag label label-dir'>Expected results</span><code>
&lt;html&gt;
	&lt;head&gt;
	&lt;/head&gt;
	&lt;div class="container"&gt;
	Hello world!!!!
	&lt;/div&gt;
&lt;/html&gt;
</code></pre>
<h2>Use Case</h2>
<p>The best place to create a layout instance, is probably your a middleware.</p>
<p>For example, create a layout within route <span class='label label-route'>public</span>. So, every route nested under it, would have the layout. </p>
<pre><code>
$app->map->addRoutes(array(
	'public' => ['path'='', 'middleware'=> function($exe)
	{
		$exe->layout = $exe->view->create('layout/default');
		$exe->layout->setRequired(['view']);
		return $exe->next($exe);
	}, 
	'subroutes' => array(
		'user' => ['path'=>'/user', 'subroutes'=> array(
			'profile' => [
				'path'=>'/[:username]',
				'execute'=> 'controller=User@profile']
		)] // end of public.user
	)] // end of public
));
</code></pre>
<p>In User controller :</p>
<pre><code>
namespace App\Controller;

class User
{
	public function __construct($exe)
	{
		// assign the layout instance to the property.
		$this->layout = $exe->layout;
		$this->exe = $exe;
	}

	public function profile()
	{
		return $this->layout
		->set('view', $this->exe->view->create('user/profile'))
		render();
	}
}
</code></pre>
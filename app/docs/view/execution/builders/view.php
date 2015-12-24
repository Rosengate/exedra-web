<h1>View <span>\Exedra\Application\Builder\View</span></h1>
<p>In exedra, we have no templating engine but php itself. But, it's more than creating a simple php file. You're given a builder that is based on $exe instance, that enable to properly design your view login, required data, and even build a layout dan can contain a view.</p>
<h2>1. Create a view</h2>
<pre><code>
$app->map->addRoutes(array(
	'profile'=> ['path'=> 'user/[:username]', 'execute'=> function($exe)
	{
		$view = $exe->view->create("user/profile");
		return $view->render();
	}]
));
</code></pre>
<p>Then it may search for a file with path <b>app/view/user/profile.php</b></p>
<h2>2. Passing a data</h2>
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
<pre><span class='code-tag label label-file'>App/View/User/profile.php</span><code>
title : &lt;php? echo $title;?&gt; 
name : &lt;php? echo $username;?&gt;
age : &lt;php? echo $age;?&gt;
email : &lt;php? echo $email;?&gt;
</code></pre>
<h2>3. Required Data</h2>
<p>You may define a required data, that is useful especially in validating the existence of the data before it can be rendered. Else, the application will throw an exception. This is useful in writing up a layout, that can be re-useable over your set of application.</p>
<pre><code>
$view = $exe->view->create("user/profile");
$view->setRequiredData(['title','description', 'image']);
</code></pre>
<h2>4. Building up a layout</h2>
<p>There's no distinct in creating up a layout, than simply creating a view and render another view within it.</p>
<pre><code>
// you may use the $exe instance, and store the variable layout for later user, like in controller.
$exe->layout = $exe->view->create('layout/default')->setRequired(['view']);
</code></pre>
<pre><code>
// in the place to render the layout
$exe->layout->set('view', $exe->view->create('user/profile'))->render();
</code></pre>
<pre><span class='code-tag label label-file'>App/View/layout/default.php</span><code>
&lt;html&gt;
	&lt;head&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;php? $view->render();?&gt; 
	&lt;/body&gt;
&lt;/html&gt;
</code></pre>
<pre><span class='code-tag label label-file'>App/View/User/profile.php</span><code>
&lt;div class="container"&gt;
Hello world!!!!
&lt;/div&gt;
</code></pre>
<p><b>The rendered result :</b></p>
<pre><span class='code-tag label label-dir'>Expected results</span><code>
&lt;html&gt;
	&lt;head&gt;
	&lt;/head&gt;
	&lt;body&gt;
		Hello world!!!!! 
	&lt;/body&gt;
&lt;/html&gt;
</code></pre>
<h2>5. Use Case</h2>
<p>The best place to create a layout instance, is within your a middleware.</p>
<p>For example, create a layout within route 'public'. So, every route nested under it, would have the layout. </p>
<pre><code>
$app->map->addRoutes(array(
	'public'=> ['path'='', 'middleware'=> function($exe)
	{
		$exe->layout = $exe->view->create('layout/default');
		$exe->layout->setRequired(['view']);
		return $exe->next($exe);
	}, 
	'subroute'=>array(
		'user'=> ['path'=>'user', 'subroute'=> array(
			'profile'=> ['path'=>'[:username]', 'execute'=> 'controller=user@profile']
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
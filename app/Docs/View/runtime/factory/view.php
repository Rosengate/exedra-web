<h1>View <span>\Exedra\Factory\View</span></h1>
<p>A simple View factory to help on templating, design your view logic, required data, and even build a layout dan can contain a view.</p>
<h2>Create a view</h2>
<pre><code>
//.. runtime
$view = $exe->view->create("user/profile");

return $view->render();
</code></pre>
<p>Then it may search for a file with path <span class='label label-file'>app/View/user/profile.php</span></p>
<h2>Passing a data</h2>
<p>Example of passing a data</p>
<pre><code>
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
<p>The data get extracted as variables of their own names.</p>
<pre><span class='code-tag label label-file'>app/View/user/profile.php</span><code>
title : &lt;php? echo $title;?&gt; 
name : &lt;php? echo $username;?&gt;
age : &lt;php? echo $age;?&gt;
email : &lt;php? echo $email;?&gt;
</code></pre>
<h2>Get data</h2>
<p>Get data from the view instance, for your own use.</p>
<pre><code>
$view->set(['title' => 'About Us', 'description' => 'Lorem ipsum a text about lorem ipsum']);

$title = $view->get('title');

$description = $view->get('descrption');
</code></pre>
<h2>Required Data</h2>
<p>Defining a required data sets a contract about what your view needed before it can render.</p>
<pre><code>
$view = $exe->view->create("user/profile");

$view->setRequiredData(['title','description', 'image']);
</code></pre>
<h2>Default data</h2>
<p>Set default data on view factory, for all of the created views.</p>
<pre><code>
$exe->view->setDefaultData('exe', $exe);
</code></pre>
<h2>Output escaping</h2>
<p>Security wise, escaping user outputs is something every developer need to consider. Exedra does not automagically escape your view's data at all. Always be conscious of what and when the user data is being outputted to.</p>
<p>A simple html output escape :</p>
<pre><code>
echo htmlspecialchars($article);
</code></pre>
<p>Or you can set a default function on view factory</p>
<pre><code>
$exe->view->setDefaultData('esc', function($content)
{
	return htmlspecialchars($content, ENT_QUOTES | ENT_HTML401);
});
</code></pre>
<p>And use it in one of your view.</p>
<pre><code>
&lt?= $esc($article);?>
</code></pre>
<h2>Prepare</h2>
<p>View in exedra uses an output buffering before being returned as a string of contents. To buffer your input without executing the render() method, use prepare() method.</p>
<pre><code>
$view = $exe->view->create('about');

$view->prepare();
</code></pre>
<pre><span class='code-tag label label-file'>app/View/about.php</span><code>
&lt;?php $this->set('title', 'About Us'); ?&gt;
Hello world.
</code></pre>
<p>Back outside the view, you can get the variable prepared for you.</p>
<pre><code>
$title = $view->get('title');
</code></pre>
<p>This is great when you want to do some level of templating.</p>
<h2>Templating up a layout</h2>
<p>There's no difference in creating a layout, than simply creating a view and render another view within it.</p>
<pre><code>
// you may use the $exe instance, and store the variable layout for later user, like in controller.
$exe->layout = $exe->view->create('layout/default')->setRequired(['view']);
</code></pre>
<pre><code>
// in the place to render the layout
$view = $exe->view->create('user/profile')->prepare();

$exe->layout->set('view', $view)->render();
</code></pre>
<pre><span class='code-tag label label-file'>app/View/layout/default.php</span><code>
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;&lt;?php echo $view->get('title');?&gt;&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;php? echo $view->render();?&gt; 
	&lt;/body&gt;
&lt;/html&gt;
</code></pre>
<pre><span class='code-tag label label-file'>app/View/user/profile.php</span><code>
&lt;?php $this->set('title', 'About Me');?&gt;
&lt;div class="container"&gt;
Hello world!!!!
&lt;/div&gt;
</code></pre>
<p>The rendered result :</p>
<pre><span class='code-tag label label-dir'>Expected results</span><code>
&lt;html&gt;
	&lt;head&gt;
		&lt;title&gt;About Me&lt;/title&gt;
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
$app->map->middleware(function($exe)
{
	$exe->layout = $exe->view->create('layout/default');
	$exe->layout->setRequiredData(['view']);
	return $exe->next($exe);
});

$app->map->any('/')->group(function($any)
{
	// controller handler
	$any->get('/user/[:username]')->execute('controller=User@profile');
});
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

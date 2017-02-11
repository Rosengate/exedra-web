<h1>Url <span>\Exedra\Url, \Exedra\Url\UrlFactory</span></h1>
<p>A URL generator to help with the creation of URL</p>
<h2>Create a URL</h2>
<h3>to()</h3>
<p>Create a url with the given path</p>
<pre><code>
$url = $exe->url->to('/foo/bar');
</code></pre>
<h3>current()</h3>
<p>Create a current url</p>
<pre><code>
$url = $exe->url->current();
</code></pre>
<p>Create with an appended query string</p>
<pre><code>
$url = $exe->url->current(array('page' => 1, 'search' => 'texts'));
</code></pre>
<h3>previous()</h3>
<p>Create a previous url</p>
<pre><code>
$url = $exe->url->previous();
</code></pre>
<h3>route()</h3>
<p>Specify route name, and parameters required.</p>
<p>p/s : consider below routing for the further subtopic.</p>
<pre><code>

$app->map->any('/')->name('public')->execute(function($public)
{
	$public->any('/user')->name('user')->any(function($user)
	{
		$user->get('/')->name('index')->execute(function()
		{

		});

		$user->get('/[:username]')->name('profile')->execute(function()
		{

		});
	});

	$public->any('/page')->name('page')->execute(function()
	{

	});
});
</code></pre>
<p>Within handler for route <span class='label label-route'>public.user.index</span> : </p>
<h4>Relative Route</h4>
<p>create <span class='label label-route'>public.user.profile</span> url</p>
<pre><code>
$user->get('/')->name('index')->execute(function()
{
	$url = $exe->url->route('profile', ['username'=> 'eimihar']);
});
</code></pre>
<p>create <span class='label label-route'>public.page</span> (will throw an error, unable to create url)</p>
<pre><code class='php'>
$url = $exe->url->route('page');
</code></pre>
<p>The second example will throw an error, due to inablity to find route named 'page' under the prefix 'public.user'.</p>
<h4>Absolute Route</h4>
<p>To specify the absolute route, do this (while following the same scenario as above):</p>
<p>create url for route public.page</p>
<pre><code class='php'>
$url = $exe->url->route('@public.page');
</code></pre>
<p>Above pattern will not care on what route you're currently on.</p>
<h2>Url with route prefixing</h2>
<p>Like we've been mentioned earlier, route prefixing would basically affect on how route would be read on creating a URL. Every route mentioned in the first parameter of the URL would be prefixed with the configured route prefix. Consider below routing : </p>
<p>p/s : It's best to set a route prefix in a middleware.</p>
<pre><code>
$app->map->addRoutes(array(
	'public'=> ['path' =>'','middleware'=>function($exe){

		// prefix all the nested route with 'public'
		$exe->setRoutePrefix('public');
		return $exe->next($exe);
	}, 
	'subroute'=> array(
		'user'=> ['path' =>'user', 'subroute'=>array(
			'index'=> ['path' => '', 'execute'=> function()
			{
				// public.user.index
			}],
			'profile'=> ['path' => '[:username]', function()
			{
				// public.user.profile
			}]
		)], // end of public.user
		'page'=> ['path' =>'page', 'execute'=>function()
		{
			// public.page
		}]
	)]
));
</code></pre>
<p>So, later, all the relative route writing would be prefixed with the configured one, instead of it's parent.</p>
<p>Inside route <strong>public.user.index</strong></p>
<pre><code>
// get url for public.user.profile
$url = $exe->url->route('user.profile', ['username'=>'eimihar']);

// get url for public.page
$url = $exe->url->route('page');
</code></pre>
<h2>Base And Asset Url</h2>
<p>There may be a time that you want to configure a base url for app and asset url. You can do so through config.</p>
<pre><code>
$app->config->set('app.url', 'http://www.example.com/my-project');

$app->config->set('asset.url', 'http://www.example.com/my-project/assets');
</code></pre>
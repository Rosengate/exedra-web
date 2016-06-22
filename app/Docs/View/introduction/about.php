<h1>About Exedra</h1>
<p>Exedra is a nestful route-oriented PHP Micro-framework, capable of letting you design the map and routes of your application hierarchically, while being flexible, functional and contextual at the sametime, without much interfering with how your application is supposed to work.</p>
<p>As a microframework, there aren't much services/components you can expect. It's an alternative to anyone who seeks much minimal design yet expandable, a container based microframework</p>
<h2>URI oriented routing</h2>
<p>Imagine about having list of APIs, most of them repetitively written in nearly similar patterns.</p>
<pre><code>
GET  /api/articles
GET  /api/articles/:article-id
GET  /api/articles/:article-id/author
GET  /api/articles/:article-id/comments
POST /api/articles/:article-id/comments/
GET  /api/articles/:article-id/comments/:comment-id
</code></pre>
<p>Imagine growing this list to 5-10 times larger and maintaining them all.</p>
<p>The idea is, how about maintaining them hierarchically. Imagine about every segment of URI path, as a node. A node you can expand, validate, authenticate, maintain, separating the concern route orientedly. See this <a href='javascript:docs.load("introduction/example");'>example</a> about writing these APIs hierarchically.</p>
<h3>How about performance</h3>
<p>The routing map isn't wholly constructed unless traversed. A route along with the group/subroutes beneath it will not be traversed, if the initial validation like route methods, path segments didn't match.</p>
<h2>Route based middleware</h2>
<p>Once called <b>a before</b> and <b>after</b> filter in web development, middleware is an encompassing layer within request/response lifecycles, on which you can operate, maintain and leverage. In exedra, the use of middleware has been localized unto request-runtime-reponse lifecycle, on which they are even highly applicable on routing level.</p>
<pre><code>
$app->map->middleware(\App\Middleware\All::class)

$app->map['web']->any('/web')->group(function($group)
{
	$group->middleware(\App\Middleware\Web::class);

	$group['admin']->any('/admin')->group(function($admin)
	{
		$admin->middleware(function($exe)
		{
			if(!$exe->session->has('user'))
				throw new \Exception('User is not logged in.');

			return $exe->next($exe);
		});
	});
});
</code></pre>
<h2>Is it REST capable?</h2>
<p>Most of the convenient interfaces is already http verb oriented, the rest is designing the response, authentication, application design which is all up to developer themselves. Most of the examples shown are usually resourceful as you can see.</p>
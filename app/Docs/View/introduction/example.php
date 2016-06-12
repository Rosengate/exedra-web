<h1>Routing Example</h1>
<p>A little show off of what Exedra is capable of. Consider having these excessive pseudo APIs :</p>
<pre><code>
GET  /api/articles
GET  /api/articles/:article-id
GET  /api/articles/:article-id/author
GET  /api/articles/:article-id/comments
POST /api/articles/:article-id/comments/
GET  /api/articles/:article-id/comments/:comment-id
GET  /api/shops
GET  /api/shops/:shop-id
GET  /api/shops/:shop-id/products
GET  /api/shops/:shop-id/products/:product-id
GET  /api/shops/:shop-id/products/:product-id
GET  /api/shops/:shop-id/products/:product-id/comments
POST /api/shops/:shop-id/products/:product-id/comments
GET  /api/shops/:shop-id/products/:product-id/comments/:comment-id
</code></pre>
<p>Traditionally you might need to write each line having the same segments repeated over and over again. In exedra, these repeated segments is written as a factor or node, on which can be operated on.</p>
<pre><code>
$app->map->any('/api')->group(function($api)
{
	$api->middleware(function($exe)
	{
		try
		{
			$response = $exe->next($exe);

			if(!is_array($response))
				$response = $exe->decorate($response); // custom invokable service

		}
		catch(\Exception $e)
		{
			$response = array(
				'error' => $e->getMessage()
			);
		}

		return json_encode($response);
	});

	// api/articles
	$api->any('/articles')->group(function($articles)
	{
		$articles->middleware(function($exe)
		{
			// laravel eloquent
			$article = \Entity\Article::findOrFail($exe->param('article-id'));

			// and pass to next call stack
			return $exe->next($exe, $article);
		});

		// GET /api/articles 
		$articles->get('/')->execute(function($exe)
		{
			//.. maybe list some articles and return some collection
		});

		$articles->any('/:article-id')->group(function($article)
		{
			// GET /api/articles/:article-id
			$article->get('/')->execute($exe, $article)
			{
				//.. do something with article
			};

			// GET /api/articles/:article-id/author
			$article->get('/author')->execute(function($exe, $article)
			{
				$author = $article->author;
			});

			$article->any('/comments')->group(function($comments)
			{
				// GET /api/articles/:article-id/comments
				$comments->get('/')->execute(function($exe, $article)
				{
					return $article->comments;
				});
			});
		});
	});
});
</code></pre>
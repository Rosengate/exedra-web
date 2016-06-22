<h1>Routing Example</h1>
<p>A little show off of what Exedra is capable of. Consider having these excessive pseudo APIs :</p>
<pre><code>
GET  /api/articles
GET  /api/articles/:article-id
GET  /api/articles/:article-id/author
GET  /api/articles/:article-id/comments
POST /api/articles/:article-id/comments/
GET  /api/articles/:article-id/comments/:comment-id
GET  /api/shop
GET  /api/shop
GET  /api/shop/products
GET  /api/shop/products/:product-id
GET  /api/shop/products/:product-id/comments
POST /api/shop/products/:product-id/comments
GET  /api/shop/products/:product-id/comments/:comment-id
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
<p>It is getting complicated, so, let's minify by setting a lookup path for <span class='label label-string'>/api/shops</span> routing.</p>
<pre><code>
//.. within /api group
$api->any('/shop')->group('api.shop.php');
</code></pre>
<p>The routing will look for the routes file in {root}/app/Routes directory.</p>
<pre><span class='code-tag label label-file'>/app/Routes/api.shop.php</span><code>
&lt;?php
return function($shop)
{
	$shop->group(function($products)
	{
		// GET /api/shop/products
		$products->get('/')->execute(function($exe)
		{
			//.. list some products
		});

		$products->any('/[:product-id]')->group(function($product)
		{
			// GET /api/shop/products/:product-id
			$product->get('/')->execute(function($exe)
			{
				//.. get product record
			});

			$product->any('/comments')->group(function()
			{
				
				// GET /api/shop/products/:product-id/comments
				$comments->get('/')->execute(function($exe)
				{
					//.. list product comments
				});

				// POST /api/shop/products/:product-id/comments
				$comments->post('/')->execute(function($exe)
				{
					//.. add comment
				});

				// the rest is up to our imagination.
				$comments->any('/')->group('api.shop.product.comment.php');
			});
		});
	});
};
</code></pre>
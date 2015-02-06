<h1>HTTP Request</h1>
<p>HTTP request actually live in the scope of exedra itself, but is retrievable through the application instance, or the exe instance itself. This is to ease the developer(s) without writing too long chain of instances, in order to just get this component.</p>
<h2>1. get</h2>
<p>get value from _get parameter.</p>
<pre><code>
$page = $app->request->get['page'];

// or from exe instance.
$page = $exe->request->get['page'];
</code></pre>
<h2>2. post</h2>
<p>Get value from _post parameter</p>
<pre><code>
$username = $exe->request->post['username'];
</code></pre>
<h2>3. getMethod</h2>
<p>Get request method</p>
<pre><code>
$method = $exe->request->getMethod();
</code></pre>
<h2>4. isAjax</h2>
<p>Check whether it's an ajax request</p>
<pre><code>
if($exe->request->isAjax())
{
	// do stuff
}
</code></pre>
<h2>5. getURI</h2>
<p>Get URI of the request</p>
<pre><code>
$uri = $exe->request->getURI();
</code></pre>
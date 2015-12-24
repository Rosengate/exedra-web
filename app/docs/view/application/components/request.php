<h1>HTTP Request <span>\Exedra\HTTP\Request</span></h1>
<p style="color: red;">Need a major overhaul. Going to adapt PSR-7 message interfaces.</p>
<p>HTTP request actually live in the scope of exedra itself, but is retrievable through the application instance, or the exe instance itself. This is to ease the developer(s) without writing too long chain of instances, in order to just get this component.</p>
<h2>1. Retrieving Request Parameter</h2>
<h3>1.1. param</h3>
Get either from _POST or _GET, depending on which http request method was made.
<pre><code>
$email = $exe->request->param('email');
</code></pre>
<h3>1.2. get</h3>
<p>get value from _get parameter.</p>
<pre><code>
$page = $app->request->get('page');

// or from exe instance.
$page = $exe->request->get('page');
</code></pre>
<h3>1.3. post</h3>
<p>Get value from _post parameter</p>
<pre><code>
$username = $exe->request->post('username');
</code></pre>
<h2>2. getMethod</h2>
<p>Get request <b>method</b></p>
<pre><code>
$method = $exe->request->getMethod();
</code></pre>
<h2>3. isMethod</h2>
<p>Equate with the current method</p>
<pre><code>
if($exe->request->isMethod('post'))
{

}
</code></pre>
<h2>3. isAjax</h2>
<p>Check whether it's an <b>XML HTTP Request</b></p>
<pre><code>
if($exe->request->isAjax())
{
	// do stuff
}
</code></pre>
<h2>4. getUri</h2>
<p>Get <b>URI</b> of the request</p>
<p style="color: red;">To be renamed to getUriPath</p>
<pre><code>
$uri = $exe->request->getUri();
</code></pre>
<h2>5. isSecure</h2>
<p>Check the current request scheme. Return true if HTTPS.</p>
<pre><code>
if($exe->request->isSecure())
{
	// do something.
}
</code></pre>
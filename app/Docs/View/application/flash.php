<h1>Flash <span>\Exedra\Session\Flash</span></h1>
<p>Flash is basically made with the original session manager as dependency, except that it lasts a single request.</p>
<h2>set</h2>
<pre><code>
$exe->flash->set('success', 'Hello world!');
</code></pre>
<h2>get</h2>
<pre><code>
$exe->flash->get('success');
</code></pre>
<h2>has</h2>
<pre><code>
if($exe->flash->has('success'))
{
	//.. do something
}
</code></pre>
<h2>clear</h2>
<p>Clear flash data</p>
<pre><code>
$exe->flash->clear();
</code></pre>
<p>Clear single data</p>
<pre><code>
$exe->flash->clear('success');
</code></pre>
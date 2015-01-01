<h1>Flash</h1>
<p>Flash is basically made of a session (on key <b>flash</b>), except it lasts a single request.</p>
<h2>1. set</h2>
<pre><code>
$exe->flash->set('message','Hello world!');
</code></pre>
<h2>2. get</h2>
<pre><code>
$exe->flash->get('message');
</code></pre>
<h2>3. has</h2>
<pre><code>
if($exe->flash->has('message'))
{
// do something
}
</code></pre>
<h2>4. clear</h2>
<p>Clear flash data</p>
<pre><code>
$exe->flash->clear();
</code></pre>
<p>Clear single data</p>
<pre><code>
$exe->flash->clear('message');
</code></pre>
<h1>Session <span>\Exedra\Session\Session</span></h1>
<p>A dot notated native session manager.</p>
<p>Being a shared dependency, this service is retrievable on both application and execution context.</p>
<h2>set</h2>
<p>Set a session value.</p>
<pre><code>
// by $app instance
$app->session->set('user', 'john');

// by $exe instance
$exe->session->set('user', 'remi');
</code></pre>
<h2>has</h2>
<p>Check whether the session with given key exists or not</p>
<pre><code>
$exe->session->has('user');
</code></pre>
<h2>get</h2>
<p>Get the session value</p>
<pre><code>
$user = $exe->session->get('user');
</code></pre>
<h2>destroy</h2>
<pre><code>
// destroy selected key
$exe->session->destroy('user');

// destroy all session
$exe->session->destroy();
</code></pre>
<h2>Multi-dimensional key</h2>
<p>This session manager basically uses array by dot notation separator.</p>
<p>For example, you have these keys : </p>
<pre><code>
// set different key on the same parent key
$exe->session->set('user.pencils', 'pencils');
$exe->session->set('user.books', 'books');
</code></pre>
<p>Deleting 'user' session would basically delete both user.pencils and user.books key.</p>
<pre><code>
$exe->session->destroy('user');
</code></pre>
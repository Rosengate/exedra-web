<h1>Session <span>\Exedra\Application\Session\Session</span></h1>
<p>Handle the session across the request</p>
<h2>1. set</h2>
<p>Session is basically part of application instance ($app), but you may still retrieve from $exe instance itself.</p>
<pre><code>
// by $app instance
$app->session->set('user', 1);

// by $exe instance
$exe->session->set('user', 1);
</code></pre>
<h2>2. has</h2>
<p>Check whether the session exists or not</p>
<pre><code>
$exe->session->has('user');
</code></pre>
<h2>3. get</h2>
<p>Get the session value</p>
<pre><code>
$user = $exe->session->get('user');
</code></pre>
<h2>4. destroy</h2>
<pre><code>
// destroy selected key
$exe->session->destroy('user');

// destroy all session
$exe->session->destroy();
</code></pre>
<h2>5. Multikey session</h2>
<p>This session manager basically uses array by dot notation separator.</p>
<p>For example, you have these keys : </p>
<pre><code>
// set different key on the same parent key
$exe->session->set('user.pens', 'pens');
$exe->session->set('user.books', 'books');
</code></pre>
<p>Deleting 'user' session would basically delete both user.pens and user.books</p>
<pre><code>
$exe->session->destroy('user');
</code></pre>
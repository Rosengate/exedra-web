<h1>Redirection</h1>
<p>A utility class that help you do a route oriented redirection.</p>
<h2>1. to</h2>
<p>This method at it's core uses url builder. So, the first parameter would be tied relatively to current execution context.</p>
<p>Consider having this routing scenario :</p>
<div>
<div style="padding-left:20px;opacity:0.8;">
<p>Let say we have a 3 routes : </p>
<p>1. public.user.index</p>
<p>2. public.user.view (uri : <b>user/[:username]</b> )</p>
<p>3. backend.dashboard</p>
<p>And routePrefix set to 'public'</p>
</div>
<p>At <b>public.user.view</b> to <b>public.user.update</b></p>
<pre><code>
return $exe->redirect->to('user.update');
	</code></pre>
At <b>backend.dashboard</b> to <b>public.user.view</b>
<pre><code>
return $exe->redirect->to('@public.user.view', ['username'=> 'eimihar']);
</code></pre>
<h2>2. toUrl</h2>
<p>This method redirects to the given url.</p>
<pre><code>
return $exe->redirect->toUrl('http://www.google.com.my');
</code></pre>
<h2>3. refresh</h2>
<p>Refresh or redirect to the same page.</p>
<pre><code>
return $exe->redirect->refresh();
</code></pre>
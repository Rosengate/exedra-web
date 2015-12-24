<h1>Redirection <span>\Exedra\Application\Response\Redirect</span></h1>
<p>A utility class that help you do a route oriented redirection.</p>
<h2>1. to</h2>
<p>This method at it's core uses url builder. So, the first parameter would be tied relatively to current execution context.</p>
<p>Consider having this routing scenario :</p>
<div>
<div style="padding:6px 6px 6px 20px;background:white;box-shadow: 0px 0px 5px #c0c0c0;font-size: 0.9em;">
	<p>Let say we have 3 routes : </p>
	<p>1. <span class='label label-route'>public.user.index</span></p>
	<p>2. <span class='label label-route'>public.user.view</span> (uri path : <b class='label label-string'>user/[:username]</b> )</p>
	<p>3. <span class='label label-route'>backend.dashboard</span></p>
	<!-- <p>With <span class='label label-property'>base</span> property set to <span class='label label-string'>public</span>.</p> -->
</div>
<p style="margin-top:10px;">At <b class='label label-route'>public.user.view</b> to <b class='label label-route'>public.user.update</b></p>
<pre><code>
return $exe->redirect->to('user.update');
	</code></pre>
<p>At <b class='label label-route'>backend.dashboard</b> to <b class='label label-route'>public.user.view</b></p>
<pre><code>
return $exe->redirect->to('@public.user.view', ['username'=> 'eimihar']);
</code></pre>
<h5>Tagged route example</h5>
<pre><code>
return $exe->redirect->to('#userView', ['username' => 'eimihar']);
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
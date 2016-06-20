<h1>Executing your application</h1>
<p>There're several ways [2] to execute your application.</p>
<h2>Http Request</h2>
<h4>dispatch(\Exedra\Http\ServerRequest $request = null)</h4>
<p>This method respond to your request and send response header. Initially take the request from the application <span class='label label-property'>$app->request</span>.</p>
<pre><code>
$app->dispatch();
</code></pre>
<p>Or you pass the request explicitly as a first argument.</p>
<pre><code class='php'>
$app->dispatch(\Exedra\Http\ServerRequest::createFromGlobals());
</code></pre>
<p>Test with a mocked instance</p>
<pre><code>
use Exedra\Http\ServerRequest;

$app->dispatch(ServerRequest::createFromArray(array('uri' => 'http://www.example.com/foo/bar')));
</code></pre>
<h4>respond(\Exedra\Http\ServerRequest $request)</h4>
<p>Almost similar with dispatch(), but returns response (<span class='label label-class'>\Exedra\Runtime\Response</span>) object a subclass of <span class='label label-class'>\Exedra\Http\Response</span>, and mandatorily require <span class='label label-class'>\Exedra\Http\ServerRequest</span></p>
<pre><code>
$response = $app->respond($request);
</code></pre>
<h4>request(\Exedra\Http\ServerRequest $request = null)</h4>
<p>Similar but returns \Exedra\Response\Exec, and optionally receives <span class='label label-class'>\Exedra\Http\ServerRequest</span></p>
<pre><code>
$exe = $app->request();
</code></pre>
<h2>Route Execute</h2>
<h4>execute(string $routeName)</h4>
<p>Execute route directly by the given route name.</p>
<pre><code>
$exe = $app->execute('foo.bar');
</code></pre>

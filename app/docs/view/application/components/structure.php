<h1>Structure</h1>
<p>One of exedra core component, provide you a methods to modify your application (folder) structure and conventions (folders especially) for your own need.</p>
<h2>1. add</h2>
<pre><code>
$app->structure->add('storage', 'storage');
</code></pre>
<p>Or add a structure by list of array.</p>
<pre><code>
$app->structure->add(array(
	'reports'=> 'reports'
));
</code></pre>
<h2>2. Existing</h2>
<p>Structures are used mostly by Exedra's components. Total existing structures (in the class' constructor) registered were :<br>
p/s : subject to changes.</p>
<pre><code>
// as seen in \Exedra\Application\Structure\Structure
$this->add(array(
"controller"	=>"controller", // used by Exedra\Application\Builder\Controller
"model"			=>"model", 
"config"		=>"config", // used by Exedra\Application\Config
"view"			=>"view",	// used by Exedra\Application\Builder\View
"route"			=>"routes", // used when you use a load syntax.
"documents"	=>"documents",
"middleware"	=>"middleware", // used by for Exedra\Application\Builder\Middleware
"storage"		=>"storage")); 
</code></pre>
<h2>3. Update</h2>
<p>You may update the existing structure. Use method <b>set</b></p>
<pre><code>
$app->structure->set('controller', 'kawalan');
</code></pre>
<p>Or set by array, for example.</p>
<pre><code>
$app->structure->set(array(
'config' => 'konfigurasi',
'view' => 'paparan',
'route' => 'hala',
'documents' => 'dokumen'
));
</code></pre>
<h2>4. Usage</h2>
<p>Structure may also be used by a loader. Examples are shown on the <a href='<?php echo $exe->url->create('default', ['view'=> ['application','components','loader']]);?>'>next topic.</a></p>
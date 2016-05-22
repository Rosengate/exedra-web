<h1>Setup And Installation</h1>
<p>You may install exedra using any of the following ways.</p>
<p>But, first create your project folder and change directory into the folder.</p>
<h2>Composer</h2>
<p>Composer is a modern tool that helps you with packages management, if you don't have one yet, please do so by visiting their site and install.</p>
<p>And require the repo using your favorite CLI.</p>
<pre><code>
composer require rosengate/exedra dev-master
</code></pre>
<h2>Git Clone</h2>
<p>You may git clone and then do the autoloading by your own if you want, or use ours.</p>
<pre><code>
git clone https://github.com/rosengate/exedra
</code></pre>
<p>To use our autoloader.</p>
<pre><code>
require_once __DIR__.'/path/to/Exedra/Path.php';

$path = new \Exedra\Path(__DIR__);

$path->autoloadPsr4('Exedra', __DIR__.'/path/to/Exedra');
</code></pre>
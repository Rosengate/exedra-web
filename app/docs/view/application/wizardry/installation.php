<h1>Wizardry<span>\Exedra\Console\Wizard\Wizardry</span></h1>
<p>So, you might have read the previous topic, and wonder why this topic comes later (if you haven't, please do so). Simply because, this topic tells you about generating your application skeleton through the help of dark magic and necromancy (pun intended).</p>
<p>But the side effect of not knowing the mechanism behind how a structure and flow of an application can be troubling. However, it's ok if you're aware of the risk.</p>
<h2>1. Installing Exedra Wizard</h2>
<p>With an assumption that you <u class='label label-danger'>have git cloned or composer required exedra</u> and <u class='label label-danger'>a clean folder directory</u> (without any code yet),<br> Then please create below files <strong><u>(not folder)</u></strong> under your project root directory :</p>
<pre><span class='code-tag label label-dir'>/</span><code>
exedra
wizard
</code></pre>
<p>And write below codes within each file respectively</p>
<pre><span class='code-tag label label-file'>exedra</span><code>
require 'vendor/autoload.php'; // or wherever exedra is placed

return new \Exedra\Exedra(__DIR__);
</code></pre>
<pre><span class='code-tag label label-file'>wizard</span><code>
$exedra = require 'exedra';

$exedra->wizard($argv);
</code></pre>
<p>The first file (<strong class='label label-file'>exedra</strong>) must return an \Exedra\Exedra instance. The second one (<b class='label label-file'>wizard</b>) will be used as a wizard through a CLI which we'll cover on the <a href='<?php echo $exe->url->create('default', ['view' => 'application/wizardry/start']);?>'>next topic</a>.</p>
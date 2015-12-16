<h1>Wizardry : Start</h1>
<p>This wizard will help you create a simple skeleton for your application. It currently has only one command though.</p>
<h2>1. start</h2>
<p>Just run below command under your project root directory. 
<span class='label label-danger'>You must have done the <a href='<?php echo $exe->url->create('default', ['view' => 'wizardry/installation']);?>'>previous topic</a></span></p>
<pre><code>
php wizard start
</code></pre>
<p>And then, just follow whatever the wizard is telling you.<br>
Then, if you're done you'll notice that a fancy skeleton have been conjured under your root directory.</p>
<p>If you're just doing the default choices, it will generate something similar like this :</p>
<pre><span class='code-tag label label-dir'>/</span><code>
App/
  View/
    hello.php
  app.php
  wizard.config.php
public/
  index.php
app.wizard
</code></pre>
<h2>1.1 Skeleton</h2>
<p>Basically it generates <b>two folder</b> and a single file under your root directory.<br>Let's us technically explain each items:</p>
<h3><span class='label label-dir'>App/</span></h3>
<p>Location of all of your application codebase, your MVC structure, and anything within application context. It's defined when you build an application using <em>\Exedra\Exedra::build</em></p>
<h3><span class='label label-file'>App/app.php</span></h3>
<p>Your main application code, this file also returns the application <span class='label label-class'>\Exedra\Application\Application</span> instance itself. <br>For the use inside of <span class='label label-file'>/public/index.php</span>.<br> It's something similar to what we've been trying to do in the <a href='<?php echo $exe->url->create('default', ['view' => 'application/boot']);?>'>previous booting up topic.</a>.</p>
<h3><span class='label label-file'>App/wizard.config.php</span></h3>
<p>A wizardry generated config, for some trivial use of dark magic.</p>
<h3><span class='label label-dir'>public/</span></h3>
<p>Your supposed public/ folder.</p>
<h3><span class='label label-file'>public/index.php</span></h3>
<p>The main front-controller of your application.</p>
<h3><span class='label label-file'>app.wizard<span class='label label-dir'></h3>
<p>An app based wizard. You may rename this file to whatever name you want, as it won't really affect the way the wizardry works.</p>
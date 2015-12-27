<h1>Introduction</h1>
<p>Exedra is a nestable route-oriented PHP Micro-framework, capable of letting you design the map and routes of your application hierarchically, while being flexible and contextual at the sametime, without much interfering with how your application is supposed to work.</p>
<h2>1. Features</h2>
<h4>1.1. Nestable routing</h4>
<p>Routes are nestable, and each one is unique, at least if you're giving them a name. And no routes are eager-loaded, until validated on HTTP URI level, unless if you loop the map of the routes, using it's own internal method. For example :</p>
<div class='container-figure'>
	<img style="border: 1px solid #dddddd; width: 100%; " src="<?php echo $exe->url->asset('images/exedra-map-2.png');?>">
	<div class='figure-text'>Figure Routing Map Example 1</div>
</div>
<h4>1.2. Adaptive components</h4>
<div style="padding-left: 10px;">
	<h5>1.2.1 Execution handlers</h5>
	<p>While currently there're only two handlers (a \Closure and controller) for a successful execution, you may even write your own handler pattern.</p>
	<h5>1.2.2 Adaptive routing</h5>
	<p>You may also register your own routing component onto the existing ones.</p>
</div>
<h4>1.3. Stackable Middleware</h4>
<p>Middleware is designed to be a route based, and stackable down the routing depth.</p>
<h4>1.4. MVC Capable</h4>
<p>While not pretty sure how M in MVC works for you in this non-DB related micro-framework, you're still free to design your own Controllers in your own way, by our simple controller builder.</p>
<h4>1.5. Fast</h4>
<p>Designed with minimal architecture in mind, so that it can run as fast as possible, without violating modern design and standards.</p>
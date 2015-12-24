<h1>Route Properties</h1>
<p>List of route properties.</p>
<div style="padding:10px; background: white;">
<?php $properties = array(
	'method' => array(
		'description' => 'An HTTP Method. It can be a single method, or multiple method or any. Not specifying any will set the method to <span class="label label-string">any</span>.',
		'value' => array('string or array', 'get, post, put or delete', 'or a combination delimited by \',\'', 'any')
		),
	'path' => array(
		'description' => 'A string of URI path for this route to be matched with URI path taken from $_SERVER variable. ($_SERVER[\'REQUEST_URI\'])',
		'value' => array('String of matchable URI path.', ' Or false boolean')
		),
	'ajax' => array(
		'description' => 'Boolean whether will only accept ajax request or not.',
		'value' => 'boolean of true or false'
		),
	'execute' => array(
		'description' => 'An handler pattern to be executed if route is matched, once found.',
		'value' => array(
			'An execution handler pattern.',
			'There\'re built in such as : <div style="padding-left: 10px;"><a href="'.$exe->url->create('default', array('view' => 'execution/handlers#Closure')).'">- \Closure</a></div><div style="padding-left: 10px;"><a href="'.$exe->url->create('default', array('view' => 'execution/handlers#controller')).'">- controller handler</a></div>')
		),
	'middleware' => array(
		'description' => 'Bind a middleware to this route. Any route or it\'s child matched will stack a middleware on execution time.',
		'value' => array('A \\Closure', 'Or pattern specifying the handler.')
		),
	'subroutes' => array(
		'description' => 'Nest into the current route, another list/array of routes, or path to the routes, or \Closure',
		'value' => array('Array of routes', 'Or path specifying the location of the sub-routes for lazy loading functionality.', 'Or a \Closure with child Level instance passed as the first parameter.')
		),
	'module' => array(
		'description' => 'Name of a module. Anything executed under this route and it\'s childs will be assigned to this module. <b>The controller or view looked by the execution handler pattern will be prefixed by a folder named by this given module name.</b>',
		'value' => 'String of module name.'
		),
	'base' => array(
		'description' => 'The base of routing the subroutes will be based on, on finding them within execution context',
		'value' => array('Boolean true', 'String route name')
		)
);?>
<table class='table'>
	<tr>
		<th>Properties</th>
		<th style="width: 60%;">Description</th>
		<th>Value</th>
	</tr>
	<?php foreach($properties as $property => $struct):?>
	<tr>
		<td><span class='label label-property'><?php echo $property;?></span></td>
		<td><?php echo $struct['description'];?></td>
		<td>
			<?php if(is_array($struct['value'])):?>
				<?php foreach($struct['value'] as $value):?>
					<?php echo '- '.$value.'<br>';?>
				<?php endforeach;?>
			<?php else:?>
				<?php echo $struct['value'];?>
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach;?>
</table>
</div>
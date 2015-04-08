<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Exedra Documentation</title>

		<!-- Bootstrap CSS -->
		<link href="<?php echo $exe->url->asset('css/bootstrap.min.css');?>" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset('css/docs.css');?>">
		<script src="<?php echo $exe->url->asset('js/jquery.min.js');?>"></script>
		<script src="<?php echo $exe->url->asset('js/bootstrap.min.js');?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset('devaid/plugins/font-awesome/css/font-awesome.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset("highlight-js/styles/zenburn.css");?>">
		<script type="text/javascript" src='<?php echo $exe->url->asset("highlight-js/highlight.pack.js");?>'></script>
		<script>hljs.initHighlightingOnLoad();</script>
		<script type="text/javascript">
		$(document).ready(function()
		{
			$("code").each(function(i,e)
			{
				this.innerHTML	= this.innerHTML.trim();
			});
		});
		</script>
		<style type="text/css">
			/*@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);*/
			
		</style>
		<script type="text/javascript">

		var menu = new function()
		{
			this.show = function()
			{
				$("#menu").toggle();
			}
		}
		</script>
	</head>
	<body>
		<div class='container' style="width:80%;">
			<div class="row" id='header'>
				<div class='col-sm-12'>
					<div id='docs-title'>Exédra Documentation</div>
					<div id='docs-description' style="position:absolute;padding-left:10px;">Code with sense, and consent.</div>
					<div id='top-menu'>
						<a href='<?php echo $exe->url->create('@main');?>'>Home</a> | 
						<a target="_blank" href='http://github.com/rosengate/exedra'>Github</a> | 
						<a target='_blank' href='http://eimihar.rosengate.com/about' title='Exedra Rocks!'>Author</a></div>
				</div>
			</div>
			<!-- Menu -->
			<div class="row">
				<div id='menu' class='col-sm-2'>
					<?php foreach($menu as $menuTitle=>$menuContents):?>
					<?php if(is_string($menuContents) && $menuContents == "main"):?>
						<div class='menu-title-main'>
						<?php echo $menuTitle;?>
						</div>
					<?php else:?>
						<?php
						// this looks ugly but oh well.
						$menuTitle = str_replace(array('Application :', 'Execution :'), '', $menuTitle);
						?>
						<div class='menu-title'><?php echo $menuTitle;?></div>
						<div class='menu-content'>
							<ul>
							<?php foreach($menuContents as $path=>$name):?>
								<?php $exist = $exe->view->has($path);?>
								<?php $selected = implode('/', $exe->param('view')) == $path;?>
								<?php $paths = explode("/", $path);?>
								<li class="<?php echo $exist? 'file-exist':'file-not-exist';?> <?php echo $selected ? 'active' : '';?>"><a href="<?php echo $exe->url->create("default", ["view"=>$paths]);?>"><?php echo $name;?></a></li>
							<?php endforeach;?>
							</ul>
						</div>
					<?php endif;?>
					<?php endforeach;?>
				</div>
				<div id='content-container' class="col-sm-10" style="padding-bottom:200px;">
					<a href='#' id='menu-toggle' onclick='menu.show();' class="fa fa-bars"></a href='#'>
					<?php $content->render();?>
				</div>
			</div>
			<!-- Menu Ends -->
		</div>
	</body>
</html>
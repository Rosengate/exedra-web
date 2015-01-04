<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Exedra Documentation</title>

		<!-- Bootstrap CSS -->
		<link href="<?php echo $exe->url->asset('css/bootstrap.min.css');?>" rel="stylesheet">
		<script src="<?php echo $exe->url->asset('js/jquery.min.js');?>"></script>
		<script src="<?php echo $exe->url->asset('js/bootstrap.min.js');?>"></script>
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
			@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
			body {
			  font-family: 'Open Sans', 'sans-serif';
			  background:#f0f0f0;
			}

			#menu 
			{
				padding-top:20px;
			}

			.menu-content ul
			{
				padding-left: 20px;
			}

			#content-container pre
			{
				padding:0px;
				tab-size: 4;
			}

			.file-not-exist
			{
				opacity: 0.5;
			}
		</style>
	</head>
	<body>
		
		<div style="width:90%;padding-left:5%;">
			<div class="row">
				<div class='col-sm-12'>
				<h4>Exedra Documentation</h4>
				</div>
			</div>
			<!-- Menu -->
			<div class="row">
				<div id='menu' class='col-sm-2'>
					<?php foreach($menu as $menuTitle=>$menuContents):?>
						<div class='menu-title'><?php echo $menuTitle;?></div>
						<div class='menu-content'>
							<ul>
							<?php foreach($menuContents as $path=>$name):?>
								<?php $exist = $exe->view->has($path);?>
								<?php $paths = explode("/", $path);?>
								<li class="<?php echo $exist? 'file-exist':'file-not-exist';?>"><a href="<?php echo $exe->url->create("default", ["view"=>$paths]);?>"><?php echo $name;?></a></li>
							<?php endforeach;?>
							</ul>
						</div>
					<?php endforeach;?>
				</div>
				<div id='content-container' class="col-sm-10" style="padding-bottom:200px;">
					<?php $content->render();?>
				</div>
			</div>

			<!-- Menu Ends -->

		</div>
	</body>
</html>
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
			/*@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);*/
			body {
			  font-family: 'Palatino Linotype';
			  background:#f0f0f0;
			  letter-spacing: 1px;
			}

			#docs-title
			{
				font-size:50px;
				color: #f8fcf8;
				text-shadow:0px 0px 5px #3f3f3f;
				padding:5px;
				padding-top: 10px;
				letter-spacing: 3px;
			}

			#menu 
			{
				padding-top:20px;
				background: #eaeaea;
				border-top:0px;
				box-shadow: 0px 0px 5px #616161;
				margin-top:30px;
				padding-bottom: 20px;
			}

			#top-menu a
			{
				color: #3f3f3f;
			}

			#header
			{
			}

			.menu-content
			{
			}

			.menu-content ul
			{
				list-style: none;
				padding:0px;
			}

			.menu-content ul li
			{
				border-bottom:1px dashed #a4a4a4;
				padding:3px;
				padding-left:10px;
			}

			.menu-content ul li.active a
			{
				color: #dd7c4f;
				font-weight: bold;
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

			#content-container p
			{
				color: #494949;
				font-size: 1.2em;
			}

			#content-container h1
			{
				border-bottom: 2px dashed #909090;
				padding:10px;
				color: #494949;
				text-transform: uppercase;
				font-weight: bold;
			}

			#content-container h2
			{
				color: #494949;
			}

			#content-container
			{
				padding-left:50px;
			}
		</style>
	</head>
	<body>
		<div style="width:90%;padding-left:5%;">
			<div class="row" id='header'>
				<div class='col-sm-12'>
					<div id='docs-title'>Exedra Documentation</div>
					<div id='top-menu' style="text-align:right;"><a href='<?php echo $exe->url->create('@main');?>'>Home</a> | <a target="_blank" href='http://github/rosengate/exedra-web'>Github</a> | <a href='#' title='Exedra Rocks!'>About</a></div>
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
								<?php $selected = implode('/', $exe->param('view')) == $path;?>
								<?php $paths = explode("/", $path);?>
								<li class="<?php echo $exist? 'file-exist':'file-not-exist';?> <?php echo $selected ? 'active' : '';?>"><a href="<?php echo $exe->url->create("default", ["view"=>$paths]);?>"><?php echo $name;?></a></li>
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
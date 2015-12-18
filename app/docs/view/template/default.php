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
		<link rel="stylesheet" type="text/css" href="<?php echo $exe->url->asset("highlight-js/styles/foundation.css");?>">
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
			
		</style>
		<script type="text/javascript">

		var menu = new function()
		{
			this.show = function()
			{
				$("#menu").toggle();
			}
		}

		var docs = new function()
		{
			this.baseUrl = '<?php echo $exe->url->parent();?>';
			this.load = function(page, unpushed)
			{
				$("#content-wrap").load(this.baseUrl+'/'+page, function()
				{
					$(window).scrollTop(0);

					// menu
					$('.menu-content li').removeClass('active');
					$('.menu-content li#list-'+page.split('/').join('-')).addClass('active');

					// re-highlight.
					$(document).ready(function() {
					  $('pre code').each(function(i, block) {
					  	$(this).html($.trim($(this).html()));
					    hljs.highlightBlock(block);
					  });
					});

					// hide menu if mobile mode
					if($("#menu-toggle").css('display') == 'block')
					{
						menu.show();
					}

					// history.
					if(!unpushed)
						window.history.pushState({}, '', docs.baseUrl+'/'+page);
				});
			}
		}

		// handle state backward/forward navigation
		$(window).on('popstate',function()
		{
			var url = docs.baseUrl;
			var href = window.location.href;
			var page = href.split(url+'/').join('');

			docs.load(page, true);
		});
		</script>
	</head>
	<body>
		<div class='container' style="width:60%;">
			<div class="row" id='header'>
				<div class='col-sm-12'>
					<div id='docs-title'>Exédra Documentation</div>
					<div id='docs-description' style="position:absolute;padding-left:10px;">Code with sense, and consent.</div>
					<div id='top-menu'>
						<a href='<?php echo $exe->url->create('@main');?>'>Home</a> | 
						<a target="_blank" href='http://github.com/rosengate/exedra'>Github</a> | 
						<a target='_blank' href='http://github.com/eimihar' title='Exedra Rocks!'>Author</a></div>
				</div>
			</div>
			<!-- Menu -->
			<div class="row">
				<div id='menu' class='col-sm-3'>
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
								<?php $selected = $exe->param('view') == $path;?>
								<?php $paths = explode("/", $path);
								?>
								<li id='list-<?php echo str_replace('/', '-', $path);?>' class="<?php echo $exist? 'file-exist':'file-not-exist';?> <?php echo $selected ? 'active' : '';?>">
									<a href="javascript:void(0);" onclick='docs.load("<?php echo $path;?>");'><?php echo $name;?></a>
								</li>
							<?php endforeach;?>
							</ul>
						</div>
					<?php endif;?>
					<?php endforeach;?>
				</div>
				<div id='content-container' class="col-sm-9 pull-right" style="padding-bottom:200px;">
					<a href='#' id='menu-toggle' onclick='menu.show();' class="fa fa-bars"></a href='#'>
					<div id='content-wrap'>
					<?php echo $content->render();?>
					</div>
				</div>
			</div>
			<!-- Menu Ends -->
		</div>
	</body>
</html>
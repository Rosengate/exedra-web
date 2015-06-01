<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Exedra : Route Oriented PHP Framework</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A multi-tier nestful route oriented PHP framework, shipped with a flexibility that let you design, plan and prototype your application and execution hierarchically through the map of routing">
    <meta name="author" content="Ahmad Rahimie">    
    <link rel="shortcut icon" href="favicon.ico">  
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> 
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?php echo $exe->url->asset('devaid/plugins/bootstrap/css/bootstrap.min.css');?>">
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="<?php echo $exe->url->asset('devaid/plugins/font-awesome/css/font-awesome.css');?>">
    <link rel="stylesheet" href="<?php echo $exe->url->asset('devaid/plugins/prism/prism.css');?>">
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="<?php echo $exe->url->asset('devaid/css/styles-custom.css');?>">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    #about-feature > div
    {
        height:150px;
    }

    .contact-item
    {
        font-size:1.3em;
        font-weight: bold;
        color: #323331;
    }

    .contact-item-value
    {
        color:#dc7a4c;
    }
    </style>
</head> 

<body data-spy="scroll">
    
    <!---//Facebook button code-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <!-- ******HEADER****** --> 
    <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a class="scrollto" href="#promo">
                    <span class="logo-title">Exedra PHP</span>
                </a>
            </h1><!--//logo-->              
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item sr-only"><a class="scrollto" href="#promo">Home</a></li>
                        <li class="nav-item"><a class="scrollto" href="#about">About</a></li>
                        <li class="nav-item"><a class="scrollto" href="#features">Features</a></li>
                        <li class="nav-item"><a class="scrollto" href="#docs">Docs</a></li>
                        <li class="nav-item"><a class="scrollto" href="#license">License</a></li>                        
                        <li class="nav-item last"><a class="scrollto" href="#contact">Contact</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
    
    <!-- ******PROMO****** -->
    <section id="promo" class="promo section offset-header">
        <div class="container text-center">
            <h2 class="title" style="text-shadow:0px 0px 5px black;">Exé<span class="highlight">dra</span></h2>
            <p class="intro" style="text-shadow:0px 0px 5px #526020;">A multi-tier nestful route oriented PHP framework, shipped with a flexibility that let you design, plan and prototype your application and execution hierarchically through the map of routing.</p>
            <div class="btns">
                <a class="btn btn-cta-secondary" href="https://github.com/Rosengate/exedra/archive/master.zip" target="_blank">Download</a>
                <a class="btn btn-cta-primary" href="<?php echo $docsUrl;?>">Documentation</a>
            </div>
            <ul class="meta list-inline">
                <li><a href="https://github.com/rosengate/exedra" target="_blank">View on GitHub</a></li>
                <li><a href="<?php echo $docsUrl;?>" target="_blank">Full Documentation</a></li>
            </ul><!--//meta-->
        </div><!--//container-->
        <div class="social-media">
            <div class="social-media-inner container text-center">
                <ul class="list-inline">
                    <li class="twitter-follow"><a href="https://twitter.com/eimihar" class="twitter-follow-button" data-show-count="false">Follow @Eimihar</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </li><!--//twitter-follow-->
                    <li class="twitter-tweet">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-via="eimihar" data-hashtags="exedra">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    </li><!--//twitter-tweet-->
                    <li class="facebook-like">
                         <div class="fb-like" data-href="http://exedra.rosengate.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                    </li><!--//facebook-like-->
                    <!--// Generate github buttons: https://github.com/mdo/github-buttons -->
                    <li class="github-star"><iframe src="http://ghbtns.com/github-btn.html?user=rosengate&repo=exedra&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe></li>
                    <li class="github-fork"><iframe src="http://ghbtns.com/github-btn.html?user=rosengate&repo=exedra&type=fork" allowtransparency="true" frameborder="0" scrolling="0" width="53" height="20"></iframe></li>
                    <!--//
                    <li class="github-follow"><iframe src="http://ghbtns.com/github-btn.html?user=mdo&type=follow&count=true"
  allowtransparency="true" frameborder="0" scrolling="0" width="165" height="20"></iframe></li>
                    -->
                </ul>
            </div>
        </div>
    </section><!--//promo-->
    
    <!-- ******ABOUT****** --> 
    <section id="about" class="about section">
        <div class="container">
            <h2 class="title text-center">What is Exedra?</h2>
            <p class="intro text-center">A PHP Framework built ground up, with modern design pattern in mind, to satisfy the need to do an highly route and resource oriented application, with a multi-dimensional array based route mapping, while giving you the near-maximum flexibility about your own design and configuration.</p>
            <div class="row" id='about-feature'>
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-heart"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Nestful Routing</h3>
                        <p>Write a routing beneath another route. Hierarchically design your application based on a nest-able array based routing.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Route Oriented</h3>
                        <p>From writing how your application may behave, to querying back the route for the use like building a url, to hierarchically design your application.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-crosshairs"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Useful components</h3>
                        <p>Certain components are already built along, like, session manager class, validator, form helper, MVC Builder.</p>
                    </div><!--//content-->
                </div><!--//item-->           
                <div class="clearfix visible-md"></div>    
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-tablet"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">MVC Builder</h3>
                        <p>Shipped with our favorite Model-View-Controller design and architecture factory.</p>
                    </div><!--//content-->
                </div><!--//item-->                
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-code"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Less Convention And Configuration</h3>
                        <p>There're still a configuration, and convention. But too little are required just to have your application running.</p>
                    </div><!--//content-->
                </div><!--//item-->
                <div class="item col-md-4 col-sm-6 col-xs-12">
                    <div class="icon-holder">
                        <i class="fa fa-coffee"></i>
                    </div>
                    <div class="content">
                        <h3 class="sub-title">Modular</h3>
                        <p>From MVC oriented applicable, to nestful and hierarchical application design, to subapplication division.</p>
                    </div><!--//content-->
                </div><!--//item-->               
            </div><!--//row-->            
        </div><!--//container-->
    </section><!--//about-->
    
    <!-- ******FEATURES****** --> 
    <section id="features" class="features section">
        <div class="container text-center">
            <h2 class="title">Features</h2>
            <ul class="feature-list list-unstyled">
                <li><i class="fa fa-check"></i> Route Oriented Design</li>
                <li><i class="fa fa-check"></i> Nestful Routing</li>
                <li><i class="fa fa-check"></i> Less Convention and Configuration</li>
                <li><i class="fa fa-check"></i> Modular and much decoupled</li>
                <li><i class="fa fa-check"></i> DI oriented design</li>
            </ul>
        </div><!--//container-->
    </section><!--//features-->
    
    <!-- ******DOCS****** --> 
    <section id="docs" class="docs section">
        <div class="container">
            <div class="docs-inner">
            <h2 class="title text-center">Sneak Peak</h2>            
            <div class="block">
                <h3 class="sub-title text-center">Routing</h3>
                <p>An array based routing. The depth and nest is infinite.</p>
                <div class="code-block">
                    <!--//Use Prismjs - http://prismjs.com/index.html#basic-usage -->
                    <pre><code class="language-php">
    $app->map->addRoutes(array(
        'public'=> ['uri'=> '[:user]', 'subroute'=> array(
            'about'=> ['uri'=> 'about-me', 'execute'=>'controller=main@about']
        )]
    ));
                     </code></pre>
                </div><!--//code-block-->
            </div><!--//block-->
            
            <div class="block">
                <h3 class="sub-title text-center">URL Builder</h3>
                <p>Natively create a url by route.</p>
                <div class="code-block">
                    <pre>
    <code class="language-php">
    $aboutUrl = $exe->url->create('public.about', ['user'=> 'eimihar']);
    </code></pre>
                </div><!--//code-block-->
            </div><!--//block-->
            
            <div class="block">
                <h3 class="sub-title text-center">View</h3>
                <p>Exedra uses no templating engine but PHP itself, accompanied with a builder to design your view's need.</p>
                <div class="code-block">
                    <pre><code class="language-php">
    $mylayout = $exe->view->create('layout/default');
    $mylayout->setRequired(['title', 'meta', 'content']);
                    </code></pre>
                </div><!--//code-block-->
            </div><!--//block-->   
            <div class="block">
                <h3 class="sub-title text-center">Full Documentation</h3>
                <p class="text-center">For more information, visit our <a href='<?php echo $docsUrl;?>' target='_blank'>documentation</a> or codes in Github.</p>
                <p class="text-center">
                    <a class="btn btn-cta-primary" href="https://github.com/rosengate/exedra" target="_blank">More on GitHub</a>
                </p>
            </div><!--//block-->
            
            </div><!--//docs-inner-->         
        </div><!--//container-->
    </section><!--//features-->
    
    <!-- ******LICENSE****** --> 
    <section id="license" class="license section">
        <div class="container">
            <div class="license-inner">
            <h2 class="title text-center">License</h2>
                <div class="info">
                    <p>This Framework is made by a PHP developer <a href='https://github.com/eimihar' target="_blank">Ahmad Rahimie</a> of <a href='http://github.com/rosengate' target="_blank">Rosengate</a> and is <strong>100% Free</strong> under the MIT license. However, please credit whenever you can.</p>
                </div><!--//info-->
            </div><!--//license-inner-->
        </div><!--//container-->
    </section><!--//how-->
    
    <!-- ******CONTACT****** --> 
    <section id="contact" class="contact section has-pattern">
        <div class="container">
            <div class="contact-inner">
                <h2 class="title  text-center">Contact</h2>
                <div class='contact-item text-center'>Mail me by :</div>
                    <div class='contact-item-value text-center'><a href='mail:newrehmi@gmail.com' target="_blank">newrehmi@gmail.com</a></div>
                <div class='contact-item text-center'>Or visit my facebook at :</div>
                    <div class='contact-item-value text-center'><a href='http://facebook.com/eimihar-elmeruiy' target="_blank">http://facebook.com/eimihar-elmeruiy</a></div>
                <div class='contact-item text-center'>And my homepage :</div>
                    <div class='contact-item-value text-center'><a href='http://eimihar.rosengate.com' target="_blank">http://eimihar.rosengate.com</a></div>
                <div class="info text-center" style="margin-top:30px;">
                    <h4 class="title">Get Connected</h4>
                    <ul class="social-icons list-inline">
                        <!-- <li><a href="https://twitter.com/3rdwave_themes" target="_blank"><i class="fa fa-twitter"></i></a></li> -->
                        <li><a href="https://www.facebook.com/exedraPHP" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <!-- <li><a href="https://www.linkedin.com/in/xiaoying"><i class="fa fa-linkedin"></i></a></li> -->
                        <!-- <li><a href="http://instagram.com/xyriley"><i class="fa fa-instagram"></i></a></li>   -->
                        <!-- <li><a href="https://dribbble.com/Xiaoying"><i class="fa fa-dribbble"></i></a></li>    -->
                        <!-- <li class="last"><a href="mailto: hello@3rdwavemedia.com"><i class="fa fa-envelope"></i></a></li>               -->
                    </ul>
                </div><!--//info-->
            </div><!--//contact-inner-->
        </div><!--//container-->
    </section><!--//contact-->  
      
    <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="container text-center">
            <small class="copyright">Template design credited to <a href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> with <i class="fa fa-heart"></i> and Be good o dear 2015</small>
        </div><!--//container-->
    </footer><!--//footer-->
     
    <!-- Javascript -->          
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/jquery-1.11.1.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/jquery-migrate-1.2.1.min.js');?>"></script>    
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/jquery.easing.1.3.js');?>"></script>   
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/bootstrap/js/bootstrap.min.js');?>"></script>     
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/jquery-scrollTo/jquery.scrollTo.min.js');?>"></script> 
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/plugins/prism/prism.js');?>"></script>    
    <script type="text/javascript" src="<?php echo $exe->url->asset('devaid/js/main.js');?>"></script>       
</body>
</html> 


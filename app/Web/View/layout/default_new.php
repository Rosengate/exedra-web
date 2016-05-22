<!DOCTYPE html>
<html>
<head>
  <title>Exedra | Route oriented PHP microframework</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A multi-tier nestful route oriented PHP microframework, shipped with a flexibility that let you design, plan and prototype your application and execution hierarchically through the map of routing">
  <meta name="author" content="Ahmad Rahimie">    

  <link rel="stylesheet" type="text/css" href="<?php echo $url->asset('css/bootstrap.min.css');?>">
  <script src="<?php echo $url->asset('js/jquery.min.js');?>"></script>
  <link rel="stylesheet" href="<?php echo $url->asset('devaid/plugins/font-awesome/css/font-awesome.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $url->asset("highlight-js/styles/foundation.css");?>">
  <script type="text/javascript" src='<?php echo $url->asset("highlight-js/highlight.pack.js");?>'></script>
  <script>hljs.initHighlightingOnLoad();</script>
  <script type="text/javascript">

$(document).ready(function()
{
  $("pre code").each(function(i, block)
  {
    this.innerHTML  = this.innerHTML.trim();
  });
});

  </script>
  <style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);

  *
  {
    font-family: 'Open Sans';
  }

  pre
  {
    padding: 0px;
  }
  body 
  {
    background: #f0f0f0;
  }

  .section-features .row > div
  {
    height: 130px;
  }

  .section-features .row > div > div:first-child
  {
    font-size: 1.3em;
    font-weight: bold;
  }

  .example-title
  {
    font-size: 1.1em;
    font-weight: bold;
    padding: 3px;
  }

  .section-examples
  {
    margin-bottom: 100px;
    margin-top: 70px;
  }

  .section-examples pre
  {
    margin-bottom: 15px;
  }

  .footer > div
  {
    text-align: center;
    margin-bottom: 30px;
    color: #555555;
  }

  .jumbotron a
  {
    color: #555555;
    letter-spacing: 1px;
    font-size: 1.1em;
  }

  #title-documentation
  {
    font-size: 25px;
  }
#title-exedra
{
  font-size: 150px;
}
@media (max-width:768px){
  #title-exedra
  {
    font-size: 80px;
  }

  .jumbotron a
  {
    color: #555555;
    letter-spacing: 1px;
    font-size: 1em;
  }

  .jumbotron .lead
  {
  }

  pre code
  {
    font-size: 0.9em;
  }
}

  </style>
</head>
<body>
  <div class='container'>
    <div class='jumbotron' style="text-align: center; margin-bottom: 120px;">
      <a href='<?php echo $url->create('@doc.default', ['view' => '/']);?>'>Documentation</a> | <a target="_blank" href='https://github.com/rosengate/exedra'>Github</a> | <a href='<?php echo $url->route('@doc.default', ['view' => 'introduction/installation']);?>'>Installation</a>
      <h1 id='title-exedra'>Exedra</h1>
      <p class='lead'>
        A multitier nestful route oriented <b>PHP microframework</b>, shipped with a flexibility that let you design, plan and prototype your application and execution hierarchically through the map of routing.
      </p>
    </div>
    <section class='section-features'>
      <h2 style="text-align: center; margin-bottom: 25px;">What's Exedra?</h2>
      <div class='row'>
        <div class='col-sm-4'>
          <div><span class='fa fa-share-alt'></span> Nestful Routing</div>
          <div>
            Write a routing beneath another route. Hierarchically design your application based on a nestable/groupable level of routing.
          </div>
        </div>
        <div class='col-sm-4'>
          <div><span class='fa fa-map-marker'></span> Route Oriented</div>
          <div>
            From writing how your application may behave, to querying back the route for url generation, to hierarchically design your application, to binding your middleware on any node of your route.
          </div>
        </div>
        <div class='col-sm-4'>
          <div><span class='fa fa-paste'></span> Adaptive and flexible</div>
          <div>
            Write and use your own handler, design your own routing component(s). Or customize your very own application structure.
          </div>
        </div>
      </div>
      <div class='row'>
        <div class='col-sm-4'>
          <div><span class='fa fa-code'></span> Near-zero convention and configuration</div>
          <div>
            There're still a configuration, and convention. But too little are required just to have your application running.
          </div>
        </div>
        <div class='col-sm-4'>
          <div><span class='fa fa-flash'></span> Fast</div>
          <div>It's fast. Designed with minimum architecture in mind, without sacrificing the extensibility very much.</div>
        </div>
        <div class='col-sm-4'>
          <div><span class='fa fa-gear'></span> Contextual</div>
          <div>Codes live in their context. Nothing is outworldy unless specified.</div>
        </div>
      </div>
    </section>
    <section class='section-examples'>
      <h2 style="text-align: center; margin-bottom: 25px;">Sneak peak</h2>
      <div class='row'>
        <div class='col-sm-4'>
          <div class='example-title'><span class='fa fa-share-alt'></span> Default routing</div>
          <div>
<pre><code>
$app->map->addRoutes(array(
  'person' => array(
      'method' => 'any',
      'path' => '/persons',
      'subroutes' => array(
        'list' => array(
            'method' => 'get',
            'path' => '/',
            'execute' => 'controller=Person@index'
        )
      )
    )
));
</code></pre>
<div class='example-title'><span class='fa fa-share-alt'></span> Convenient Routing</div>
<pre><code>
$app->map->any('/books')->group(function($group)
{
    $group->get('/', 'controller=Book@index')
      ->tag('bookList');

    $group->get('/[:id]')
      ->execute('controller=Book@view');
});
</code></pre>
          </div>
        </div>
        <div class='col-sm-4'>
<div class='example-title'><span class='fa fa-link'></span> URL Generator</div>
<pre><code>
// absolute route
echo $exe->url->route('@person.list');

// search tagged route
echo $exe->url->route('#bookList');
</code></pre>
<div class='example-title'><span class='fa fa-cog'></span> Creating a view</div>
<pre><code>
$view = $exe->view->create('book/list');

$view->set('title', 'List of books');
$view->set('authors', $authors);

echo $view->render();
</code></pre>
<div class='example-title'><span class='fa fa-code'></span> Form</div>
<pre><code>
echo $exe->form->text('bookTitle')
      ->attr('class="form-control"');

echo $exe->form->select('gender')
      ->setOptions(array('male', 'female'));
</code></pre>
        </div>
        <div class='col-sm-4'>
<div class='example-title'><span class='fa fa-code-fork'></span> Path handling</div>
<pre><code>
$file = $exe->path->file('Logs/message.log');

// get contents
$contents = $file->getContents();

// put contents
$file->putContents('message from mars');
</code></pre>
<div class='example-title'><span class='fa fa-save'></span> Session</div>
<pre><code>
// dot notation based session
$exe->session->set('facebook.token', $token);
$exe->session->set('facebook.perms', $perms);

// array of token, permissions
$facebookData = $exe->session->get('facebook');

// delete array of 'facebook' session data
$exe->session->destroy('facebook');
</code></pre>
        </div>
      </div><!-- row ends -->
    </section>
    <div class='footer'>
      <div>Copyright 2016 <a href='http://rosengate.com' target="_blank">Rosengate</a> | <a target="_blank" href='https://github.com/eimihar'>Ahmad Rahimie bin Ahmad Zailani</a> | Free to use under MIT license</div>
    </div>
  </div> <!-- container ends -->
</body>
</html>
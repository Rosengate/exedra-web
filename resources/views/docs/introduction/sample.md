#Usages

## Table of Contents
---
- [Simple Routes](#simple-routes)
- [Global Middleware](#global-middleware)
- [Nested Routing Example](#nested-routing-example)

---

### Simple Routes
```php
<?php
use Exedra\Routing\Context;

//.. probably some codes here..

$app->map->get('/')
    ->execute(function(Context $context) {
    });
```

You can name the route on the ```$map[key]```. This is useful when you need to refer or call this route back later.
```php
$app->map['contact-us']
    ->method(['GET', 'POST'])
    ->path('/contact-us')
    ->execute(function() {
    });
```

You can also tag the route.
```php
$app->map['faq']->get('/faq')
    ->tag('faq')->execute(function() {
    });
```

### Global Middleware
Apply middleware to all requests
```php
$app->map->middleware(function(Context $context)
{
    return $context->next($context);
});

// or specify by class name
$app->map->middleware(\App\Middleware\All::CLASS);
```

### Nested Routing Example
The main dishes of the framework
```php
$app->map['api']->any('/api')->middleware(\App\Middleware\Api::CLASS)->group(function($api)
{
    // or inversely, you can register the middleware into the current route, through this group.
    $api->middleware(\App\Middleware\ApiAuth::CLASS);
    
    $api->any('/users')->group(function($users)
    {
        // create new user
        // POST /api/users
        $users->post('/')->execute(function($context)
        {
            
        });
        
        // GET /api/users/:id
        $users->get('/:id')->execute(function($context)
        {
            return $context->param('id');
        });
    });
    
    $api->any('/channels')->group(function($channels)
    {
        // create new channel
        // POST /api/channels
        $channels->post('/')->execute(function($context)
        {
            
        });
        
        // GET /api/channels
        $channels->get('/')->execute(function($context)
        {
        
        });
        
        $channels->any('/:id')->group(function($channel)
        {
            // GET /api/channels/:id
            $channel->get('/')->execute(function()
            {
                
            });
            
            // POST /api/channels/:id/join
            $channel->post('/join')->execute(function()
            {
            
            });
        });
    });
});

return $app;
```
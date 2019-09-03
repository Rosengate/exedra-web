# Route properties
## Table of Contents
---
- [Requestable](#requestable)
- [Fail Route](#fail-route)
- [Tagging and ajax](#tagging-and-ajax)
- [Attributes](#attributes)
- [All possible properties](#all-possible-properties)
- [Exceptions](#exceptions)
- [Console Commands](#console-commands)
- [Notes](#notes)

---

### Requestable
Mark the route whether or not it's requestable (on request dispatch lookup)
```php
/**
 * @name hidden
 * @requestable false
 */
public function executeHidden()
{
}
```

### Fail Route
Set up a route where it's looked up to when there's no route found on dispatch/lookup within the current group or the groups under
```php
/**
 * @name error
 * @asFailRoute true
 * @requestable false
 */
public function get404()
{
}
```

## Tagging and ajax
```php
/**
 * @tag users
 * @ajax true
 * @middleware \App\Middleware\Auth
 */
public function executeUsers()
{
    // do something?
}
```
## Attributes
```php
public function middlewareAuth(\Exedra\Runtime\Context $context)
{
    if($context->attr('need_auth', false) && !$context->session->has('user_id'))
        throw new NotLoggedInException;
        
    return $context->next($context);
}

/**
 * @attr.need_auth true
 * @path /admin
 * @method any
 */
public function groupAdmin()
{
    return Admin::class;
}
```

## All possible properties
```php
/**
 * @name admin_default
 * @method GET|POST
 * @path /admin/:controller/:action
 * @middleware \App\Middleware\Auth
 * @middleware \App\Middleware\Csrf
 * @middleware \App\Middleware\Limiter
 * @tag admin_default
 * @attr.session_timeout 36000
 * @config.request_limit 15
 */
public function executeAdminDefault($context)
{
    // nah, just a sample.
    $controller = $context->param('controller');
    $action = $context->param('action');
    
    return (new $controller)->{$action}($context);
}
```

## Exceptions
The non route property tags like **return**, **param**, and **throws** tags and will not be parsed.

## Console Commands
This package also provides a similar command on the original route listing, except that it added a little bit more details on the result.

```php
$app = new \Exedra\Application(__DIR__);

//... do some routing

$console = new \Symfony\Component\Console\Application();

$console->add(new \Exedra\Routeller\Console\Commands\RouteListCommand($app, $app->map));

$console->run();
```

## Notes
### Routing name
For some type of usage, like **executable** and **grouped** kind of route, the route name will be taken from the
 case-lowered remaining method name, IF no **@name** property is annotated.
 
##### Route name for the restful controller
It takes a combination of verb and the method name. For example,
```php
public function postProducts()
{
    // add product or something
}

public function get()
{
    // get product or something
}
```
Above routing will have a method name like **.post-products**. (**@web.products.post-products**)

For verb only method name, it'll just be the verb as the name. And an absolute name for it would look something like :
**@web.products.get**


### Ordering
Routing order is being read from top to above. So, it matters how you code the routing.

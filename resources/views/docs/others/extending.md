# Extending Exedra

## Table of Contents
---
- [Introduction](#introduction)
- [Application](#application)
- [Services](#services)
- [Factories](#factories)
- [Routing Classes](#routing-classes)
- [Routing Handling](#routing-handling)
  - [Group Handler](#group-handler)
  - [Execute Handler](#execute-handler)
  - [Routing Handler](#routing-handler)

---

## Introduction
There might comes a point where you need to use your own ServerRequest, Application, Context, and so on. Fear no longer.

## Application
Most cases are done through factory registry, except the Application, since it's the first.

### `Exedra\Application`
```php
<?php
namespace CoolApp;

class Application extends \Exedra\Application
{
}
```
Usage
```
$app = new \CoolApp\Application(__DIR__);
```
## Services
### `Exedra\Http\ServerRequest`
```
$app->set('request', function(){
    return \CoolApp\ServerRequest::createFromGlobals();
})
```

### `Exedra\Config`
```
$app->set('config', \CoolApp\Config::class);
```

## Factories
### `Exedra\Url\UrlFactory`
```
$app->factory('url.factory', \CoolApp\Url\Factory);
```

### `Exedra\Runtime\Context`
All created `Context` will use this one instead.
```php
$app->factory('runtime.context', \CoolApp\Context::class);
```
Or if you even rather want to have much contextual `Context`
```php
$app->factory('runtime.context', function($app, \Exedra\Routing\Finding $finding, $response) {
    if($context = $finding->getAttribute('context'))
        return new $context($app, $finding, $response);
        
    return new \CoolApp\Context($app, $finding, $response);
});
```


### `Exedra\Runtime\Response`
```php
$app->factory('runtime.response', \CoolApp\Response::class);
```

## Routing classes
You can define your own routing classes through this way
```php
$app->routingFactory->register(array(
    'finding' => \CoolApp\Routing\Finding::class,
    'route' => \CoolApp\Routing\Route::class,
    'group' => \CoolApp\Routing\Group::class
));
```

## Routing Handling

### Group Handler
You can design the way your routing group is resolved.
First create an handler that implements `Exedra\Contracts\Routing\GroupHandler`.

Implementation example :

```php
use Exedra\Contracts\Routing\GroupHandler;
use Exedra\Routing\Group;

class CollectionHandler implements GroupHandler
{
     /**
     * @param mixed $pattern
     * @param Route|null $route
     * @return boolean
     */
    public function validateGroup($pattern, Route $route = null)
    {
        return strpos('resources=', $pattern) === 0;
    }

    /**
     * @param Factory $factory
     * @param mixed $pattern
     * @param Route|null $parentRoute
     * @return Group
     */
    public function resolveGroup(Factory $factory, $pattern, Route $parentRoute = null)
    {
        $group = new Group($factory, $parentRoute);
        
        // do something with the pattern, and add a routing.
        
        return $group;
    }
}
```
Then add the handler this way :
```
use CollectionHandler;

$app->routingFactory->addGroupHandler(new CollectionHandler());
```

Usage example :
```
$app->map['apis']->any('/apis')->group('resources=user');
```
### Execute Handler
You can also design the way the execute call is invoked/handled. Implements `Exedra\Contracts\Routing\ExecuteHandler`.

The implementation is similar to group handling where you just need to validate the pattern, and but this time, resolve into `\Closure` or `callable`.

Then add the handler this way :
```
$app->routingFactory->addExecuteHandler(new MyExecuteHandler());
```

Usage example :
```
$app->map['web']->get('/index')->execute('template=twig');
```

### Routing Handler
Or you can do both using only a single implementation. Create a class that implements `Exedra\Contracts\Routing\RoutingHandler`.
```
$app->routingFactory->addRoutingHandler(new MyRoutingHandler());
```

### Note
the `$pattern` for both group handler or execute handler, is not necessarily a string. It can be anything, and up to 
you to validate and resolve based on the pattern.
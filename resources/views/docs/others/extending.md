# Extending Exedra

There might comes a point where you need to use your own ServerRequest, Application, Context, and so on. Fear no longer.

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
```
$app->factory('runtime.context', \CoolApp\Context::class);
```
Or if you even rather want to have much contextual `Context`
````
$app->factory('runtime.context', function($app, \Exedra\Routing\Finding $finding, $response) {
    if($context = $finding->getAttribute('context'))
        return new $context($app, $finding, $response);
        
    return new \CoolApp\Context::class;
});
```
### `Exedra\Runtime\Response`
```
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
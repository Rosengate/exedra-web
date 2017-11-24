# Registry
## Table of Contents
---
- [Introduction](#introduction)
- [Service](#service)
- [Factory](#factory)
- [Callable](#callable)
- [Shared services, factories and callables](#shared-services,-factories-and-callables)

---

## Introduction
Both `Exedra\Application` and `Exedra\Runtime\Context` are built as `Exedra\Container\Container`. This inheritance allows you to set a lazy services, factory creating object and so on.

## Service

A service as defined here last for the lifetime of an application or a context, and yield the same value each time retrieved.
```
use Exedra\Application;

//.. some codes here probably

$app->set('pdo', function(Container $container) {
    $db = $this->config['db'];
    
    $string = 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'];
    
    $pdo = new \Pdo($string, $db['user'], $db['pass']);

    return $pdo;
});
```
The first argument receives the container itself (either `Exedra\Application` or `Exedra\Runtime\Context`).

And you can call it by directly accessing it as public member.
```
$statement = $app->pdo->query('SELECT * FROM foo');
// or
$statement = $app->get('pdo')->query('SELECT * FROM foo');
```

## Factory

This container also allows you to dynamically register an object factory.
```
$app->factory('view', function($path) {
    return new \Exedra\View\View($path);
});
```
Usage example
```
$app->create('view', ['index.php']);
```

## Callable
```
$app->func('@log', function($message)
{
	$this->log->create($mesasge);
});
```
And the callable is invokable on the application instance.
```
$app->log('Something not well.');
```

## Shared services, factories and callables
Sometimes you might prefer to setup once and share with the context. You may do so by prefixing the name 
with `@`.
```
// this example use Twig templating
$app->set('@twig', function(\Exedra\Application $app){
    $loader = new \Twig_Loader_Filesystem($app->path->to('views'));

    return new \Twig_Environment($loader);
});
```
Usage example
```
use Exedra\Runtime\Context;

//... some codes here probably

$app->map->any('/')->execute(function(Context $context) {
    return $context->twig->render('index.twig');
});
```
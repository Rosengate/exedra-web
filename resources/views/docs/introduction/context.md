# Context

## Table of Contents
---
- [Introduction](#introduction)
- [Preview](#preview)
- [Utilities](#utilities)
- [Extending](#extending)

---

## Introduction

Known as ```Exedra\Runtime\Context```. 

This object is available only within a runtime; Available within an application ```dispatch()``` or ```execute()``` runtime.
It contains information about the request and response instance, the executed route, their named parameters, the route attributes and so on.

## Preview
```php
use Exedra\Runtime\Context;

$app = new \Exedra\Application(__DIR__);

$app->map['web']
    ->any('/hello/:foo')
    ->execute(function(Context $context) {
         return $context->param('foo');
    });
    
$app->dispatch();
```
Running ```/hello/world``` in your browser would yield \````world```\` response


## Utilities
### `Context::param(string key, mixed default = null)`

Get route named param

```
$foo = $context->param('foo', 'bar');
```

### `Context::params(array keys = [])`

Get params

```
$data = $context->params();
```

Get params with specified names

```
$data = $context->params(['comment-id', 'article-id']);
```

### `Context::attr(string key, mixed default = null)`

Get routing attribute

```
$access = $context->attr('access_level');
```

### `Context::forward(string $route, array $params = [])`

Forward current request to the specified route

```
return $context->forward('@foo.404');
```

## Extending
You can either pass the class name as 2nd argument
```
$app = new \Exedra\Application(__DIR__, \MyApp\Context::class);
```
or through factory
```
$app->factory('runtime.context', \MyApp\Context::class);
```
and your context class needs to extend from `\Exedra\Runtime\Context`
# Routing
## Table of Contents
---
- [Introduction](#introduction)
- [Request Verbs](#request-verbs)
- [Route Naming](#route-naming)
- [Route Handle](#route-handle)
- [Named Parameter](#named-parameter)
- [Nested Routing](#nested-routing)
- [Attributes](#attributes)
- [Set Properties](#set-properties)
- [Validator](#validator)
- [Dependency Injection](#dependency-injection)
- [Fail Route](#fail-route)
- [Chainable API](#chainable-api)

---

## Introduction

The main component of exedra, the entry point of a request dispatch. Every route is unique, and identifable by name, taggable and findable. They're reusable to the extent of generating a url for the route, doing a route based execution, or query a route even for your own use. In this page we'll focus on writing them.

Throughout the documentation, you'll often find most routing begins with `$app->map`. This `Exedra\Routing\Group` type as we call it, is the first group of routes, unbounded to any route. It's registered as a service on application instance itself.

## Request Verbs
These methods allow us to do a quick routing through common verbs
### `GET`

create a `GET /books` with \Closure handler
```
use Exedra\Runtime\Context;

//... some codes

$app->map->get('/books')->execute(function(Context $context)
{
	return $context->controller->execute('Book', 'index');
});
```
### `POST`
`POST /books` request with controller handler pattern
```
$app->map->post('/books')->execute(function() {});
```
### `DELETE`
Create a `DELETE /books/[:id]` request
```
$app->map->delete('/books/[:id]')->execute(function() {});
```

### `PUT`
Create a `PUT /books/[:id]` request
```
$app->map->put('/books/[:id]')->execute(function() {});
```

### `PATCH`
Create a `PATCH /books/[:id]/glossary` request
```
$app->map->patch('/book/[:id]/glossary')->execute(function() {});
```

All these methods return `Exedra\Routing\Route` type.

## Route Naming
Create a named route through an array offset of the route level. Route name is useful on route finding functionality for url generator, and route based execution.
```
use Exedra\Routing\Group;

// returns \Exedra\Routing\Route
$app->map['api']->any('/api')->group(function(Group $api)
{
	$api['author']->get('/author')->execute(function() {});
});
```
Sample usage
```
echo $app->url->route('api.author'); // returns http://example.com/api/author
```
#### Route Tagging
##### `Route::tag(string name)`
Similar with naming, except method this allow a quick routing search, without knowing a full name.
```
use Exedra\Routing\Group;

$app->map['api']->any('/api')->group(function(Group $api)
{
	$api->post('/api/products')->tag('add-product')->execute(function(){ });
});
```
Sample usage
```
echo $app->url->route('#add-product');
```

## Route Handle
### `Route::execute(mixed handle)`
The route handle execution method
```
$app->map->any('/web')->execute(function() {});
```

## Named Parameter
A segment of the URI path that can be named through routing.
```
$app->map['web']->any('/web/:page')->execute(function($exe)
{
	$page = $exe->param('page');
});
```

#### Optional parameter
Matches `/dashboard` and `/dashboard/index`
```
$app->map['admin']->any('/dashboard/:action?')->execute(function($exe)
{
    // do something?
});
```

#### Catch remaining segment(s)
Matches `/article/2014/08/10`
```
$app->map['article']->any('/article/*:date')->execute(function($exe)
{
	$action = $exe->param('date'); // will yield '2014/08/10'
});
```

## Nested routing
Setting `subroutes` property by using `group()` method on the `\Exedra\Routing\Route` instance.
```
use Exedra\Routing\Group;

//.. some codes

$app->map['api']->any('/api')->group(function(Group $group)
{
	$group['books']->any('/books')->group(function(Group $books)
	{
		$books['list']->get('/', function() {});

		$books['get']->any('/:id', function() {});
	});
});
```

## Attributes
### `Route::attr(string key, mixed value)`
Set the route key value attribute
```
use Exedra\Runtime\Context;

// .. some codes

$app->map['admin']->any('/')
    ->attr('check_session', true)
    ->execute(function(Context $context) {
        if($context->attr('check_session')) {
            // etc2
        }
    });
```

## Set properties
Set whole routing properties
```
$app->map->get('/authors')->setProperties(array(
	'name' => 'author',
	'ajax' => true,
	'execute' => function()
	{

	}
));
```

## Validator
Add a custom validator on your routing.

It's expected to return `boolean` for the validation result.

#### With closure
```php
<?php
$app->map->get('/author/:id')
    ->validate(function($params) {
        return is_int($params['id']);
    })
    ->execute(function() {
        
    });
```

#### Class name
The class must implement `Exedra\Contracts\Routing\Validator`.
```
$app->map->get('/books/:name')
    ->validate(AlphanumericValidator::class);
```

## Dependency injection
List name of registered services to be injected into the runtime handle.
```
// define a pdo sample service
$app->set('@pdo', function(\Exedra\Application $app) {
    $db = $app->config['db'];
        
    $string = 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'];
    
    $pdo = new \Pdo($string, $db['user'], $db['pass']);

    return $pdo;
});

$app->map->get('/user/:user-id')
    ->inject(['pdo', 'context'])
    ->execute(function(\Pdo, \Exedra\Runtime\Context $context) {
    
    });
```

## Fail Route
Set up a route where it's looked up to when there's no route found on dispatch/lookup within the current group or the groups under

#### Set from group
```php
$app->map->setFailRoute('error');

$app->map['error']->any('/404')->execute(function () {
    // do something
});
```

#### Set from route
```php
$app->map['error']->any('/404')
->asFailRoute()
->execute(function() {
    // do something
});
```

## Chainable API
Most route property setter methods return the same instance, making it capable of chaining methods.

```
$app->map['books']->get('/books')
    ->tag('bookList')
    ->attr('authenticable', true)
    ->execute(function() {});
```
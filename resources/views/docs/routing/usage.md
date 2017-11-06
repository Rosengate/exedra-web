# Routing
`Exedra\Routing\*`

The main component of exedra, the entry point of a request dispatch. Every route is unique, and identifable by name, taggable and findable. They're reusable to the extent of generating a url for the route, doing a route based execution, or query a route even for your own use. In this page we'll focus on writing them.

## Introduction

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
// returns \Exedra\Routing\Route
$app->map['api']->any('/api')->group(function($api)
{
	$api['author']->get('/author')->execute(function() {});
});
```
Sample usage
```
echo $app->url->route('api.author'); // returns http://example.com/api/author
```
#### Route Tagging
Similar with naming, except method this allow a quick routing search, without knowing a full name.
```
$app->map['api']->any('/api')->group(function($api)
{
	$api->post('/api/products')->tag('add-product')->execute(function(){ });
});
```
Sample usage
```
echo $app->url->route('#add-product');
```

## Route execute
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

## Set properties
```
$app->map->get('/authors')->setProperties(array(
	'name' => 'author',
	'ajax' => true,
	'execute' => function()
	{

	}
));
```

## Dependency injection
List name of registered services to be injected into the runtime handle.
```
// sample with \Pdo
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

## Chainable API
Most route property setter methods return the same instance, making it capable of chaining methods.

```
$app->map['books']->get('/books')
    ->tag('bookList')
    ->attr('authenticable', true)
    ->execute(function() {});
```
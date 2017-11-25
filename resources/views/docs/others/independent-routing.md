# Independent Routing

## Table of Contents
- [Introduction](#introduction)
- [Example](#example)
- [Component Summary](#component-summary)

---

## Introduction
The routing component is built in a way it can independently work with PSR7 http message.

The only thing the routing components care is, the PSR7 `ServerRequestInterface`. Refer below for full example on how to
implement them independently.

## Example
This example uses GuzzleHttp ServerRequest.

### Setting up
Create the first level of routing group through the routing factory.
```
use Exedra\Routing\Group;
use \GuzzleHttp\Psr7\ServerRequest;

$routingFactory = new \Exedra\Routing\Factory;

$router = $routingFactory->createGroup();
```
### The routing default handler
Add a default routing handler, and write some sameple test.
```
$router->addExecuteHandler('execute', \Exedra\Routing\ExecuteHandlers\ClosureHandler::class);

// a simple routing, and some middleware
$router->middleware(function(ServerRequest $request, $next) {
    return $next($request);
});

$router['hello']->any('/hello')->group(function(Group $group) {
    $group['world']->any('/world')->execute(function() {
        return 'hello world';
    });
});
```
### Request dispatching
Find matching by given request, and echo the matching response.
````
// dispatch the guzzle ServerRequest
try {
    $finding = $router->findByRequest($request = ServerRequest::fromGlobals());
} catch(\Exedra\Exception\RouteNotFoundException $e) {
    echo 'Oops, route not found';
    exit;
}

$callStack = $finding->getCallStack();

echo $callStack->next($request, $callStack->getNextCaller());
```

## Component Summary
Here's the brief summary of what each component does

- `Exedra\Routing\Factory` the factory object that helps on routing component creation
- `Exedra\Routing\Group` the routing group
- `Exedra\Routing\Route` the route
- `Exedra\Routing\Finding` an object that encapsulate the matching result of the find method. 
- `Exedra\Routing\CallStack` object holds all the calls information of the matched result. This includes all middlewares and the execute handle.
- `CallStack::getNextCaller()`, a utility method, to get the \Closure for calling the next callable in the stack. You can always write your own $next if you want. Check the code for example.
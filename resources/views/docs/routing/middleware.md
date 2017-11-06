# Middleware

Middleware is simply a layer(s) that surrounds your application runtime. In Exedra, the concept of middleware no longer bound to handling request/response only, but anything including your domain logic.

On the runtime, middlewares are stacked into the final call stack, and make no distinction whether it's global or route based.

## Adding a middleware
### Global middleware
This middleware get stacked on every runtime.
Apply a `\Closure` based middleware.
```
$app->map->middleware(function(\Exedra\Runtime\Context $context)
{
	return $context->next($context);
});
```

### Route based middleware
Apply middleware to a routing group
```
$app->map['admin']->any('/admin')
    ->middleware(function(\Exedra\Runtime\Context $context)
    {
        // redirect to route with tag auth.
        if(!$context->session->has('user'))
            return $context->redirect->route('#auth');
    
        return $context->next($context);
    })->group(function(\Exedra\Routing\Group $group)
    {
        $group['default']->any('/')->execute(function() {
            \\ do something
        });
    });
```

## Middleware class
Apply given class based middleware
```
$app->middleware->add(\App\Middleware\Auth::class);
```
Implementation
```
<?php
namespace App\Middleware;
use Exedra\Runtime\Context;

class Auth
{
	public function handle(Context $context)
	{
		return $context->next($context);
	}
}
```
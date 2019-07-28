# Basic Usage
## Table of Contents
---
- [Controller initial register](#controller-initial-register)
- [Adding executable routes](#adding-executable-routes)
- [Adding plain routes](#adding-plain-routes)
- [Middleware](#middleware)
- [Dependency injection](#dependency-injection)
- [Normal Routing](#normal-routing)

---

## Controller initial register
On your preferred route, register the first controller through the *group()* method.
```php
$app->map['web']->group(\App\Controller\WebController::class);
```
The controller **MUST** by type of `\Exedra\Routeller\Controller\Controller`.
```php
<?php
namespace App\Controller;

use Exedra\Routeller\Controller\Controller;

class WebController extends Controller {

}
```
## Adding executable routes
Annotate the method with the route properties. The method name has to be prefixed with *execute*.
```php
<?php
namespace App\Controller;

use Exedra\Runtime\Context;

class WebController extends \Exedra\Routeller\Controller\Controller
{
    /**
     * @path /
     */
    public function executeIndex(Context $context)
    {
        return 'This is index page';
    }
    
    /**
     * @name about-us
     * @path /about-us
     * @method GET|POST
     */
    public function executeAboutUs(Context $context)
    {
        return 'This is about page';
    }
}
```
Doing above is similar to doing :
```php
use Exedra\Routing\Group;
use Exedra\Runtime\Context;

$app->map['web']->group(function(Group $group) {
    $group['index']->any('/')->execute(function(Context $context) {
        return 'This is index page';
    });
    
    $group['about-us']->any('/about-us')->execute(function(Context $context) {
        return 'This is about page';
    });
});
```

## Adding plain routes
You may want to customize the route more object orientedly, prefix with `route`. You will be given ```Route``` instance as the first parameter.
```php
/**
 * @path /faq
 */
public function routeFaq(\Exedra\Routing\Route $route)
{
    $route->execute(function() {
    
    });
}
```

# Middleware
Add a middleware for the current group's route, by prefixing the method name with `middleware`.
 This method expects no annotation.
```php
public function middlewareAuth(Context $context)
{
    if(!$context->session->has('user_id'))
        return $context->redirect->route('@web.login');

    return $context->next($context);
}
```
The middleware name is optional though, so, you can still set it.
```php
/**
 * @name csrf
 */
public function middlewareCsrf()
{
    return $context->next($context);
}
```

## Dependency injection
Inject with known service(s)
```php
use Exedra\Url\UrlGenerator;

/**
 * @inject context.url
 * @path /
 */
public function get(UrlGenerator $url)
{
    echo $url->current();
}
```
Multiple services
```php
use Exedra\Runtime\Context;
use Exedra\Application;
use Exedra\Routing\Group;

/**
 * @inject context, url, self.response, app, app.map
 * @path /
 */
 public function post(Context $context, $url, $response, Application $app, Group $map)
 {
 }
```
### Notes
- ```self``` and ```context``` is the same thing that is a type of \Exedra\Runtime\Context, the context of the current runtime.
- the services prefixed with ```app.``` will instead look inside the ```Exedra\Application``` container 
- without a prefix, ```context.```, ```self.``` or ```app.```, the resolve will only look for the service registered in the `Context` instance.

### Normal routing
You can also do a usual routing by prefixing the method name with `setup`. This method expects no annotation.
```php
public function setup(Group $group)
{
    $group->get('/')->execute(function() {
    });
}

public function setupCustom(Group $group)
{
    // do another thing
}
```
This method also receives `Exedra\Application` as the second argument.

```php
/**
 * @path /comments
 */
public function setup(Group $group, \Exedra\Application $app)
{
    $group->get('/')->execute(function() {
    });
}
```
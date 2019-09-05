# Routing Group
## Table of Contents
---
- [Subrouting / Nest-Routing](#subrouting-/-nest-routing)
- [Deferred subrouting](#subrouting-/-nest-routing)
- [Immediate subrouting](#immediate-subrouting)

---

### Subrouting / Nest-Routing
Create a sub-routing. The method name must be prefixed with `group`.

The method must return the routing group pattern. All routing properties are valid as tag here.
```php
/**
 * @path /products
 */
public function groupProducts()
{
    return \App\Controller\ProductController::class;
}
```

*The routing group under this method is resolved only when it's accessed.*

### Deferred subrouting
Similar to above but you can defer the routing properties to the controller's class annotation itself.
However, properties annotated on method level will still override the class's.
```php
public function groupBlog()
{
    return \App\Controller\BlogController::class;
}
```
Controller implementation
```
<?php
namespace \App\Controller;

use Exedra\Routeller\Controller\Controller;

/**
 * @name blog
 * @path /:article-id
 */
class BlogController extend Controller
{
}
```

### Immediate subrouting
Similar to `group` prefix, except that this one have their group resolved immediately. Prefix with `sub`.
```php
/**
 * @path /:product-id
 */
public function subProduct(Group $group)
{
    $group['get']->get('/')->execute(function() {
        // do your things
    });
    
    $group['update']->post('/')->execute(function() {
        // do your things
    });
}
```
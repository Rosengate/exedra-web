# Routing Group
## Table of Contents
---
- [Subrouting / Nest-Routing](#subrouting-/-nest-routing)
- [Immediate subrouting](#immediate-subrouting)
- [Normal routing](#normal-routing)

---

### Subrouting / Nest-Routing
Add a subgroup route. The method name must be prefixed with `group`.

The method must return the routing group pattern.
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

### Immediate subrouting
Similar to `group` prefix, except that this one have their group resolved immediately.
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
# Routing Group
## Table of Contents
---
- [Subrouting / Nest-Routing](#subrouting-/-nest-routing)
- [Immediate subrouting](#immediate-subrouting)

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
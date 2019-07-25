# Restful verbs
This controller also support a simple restful mapping.

## GET, POST, PUT, PATCH, DELETE verb
Prefix each method with the http verb as you like.
```php
/**
 * Get all products
 * @path /
 */
public function getProducts(Context $context)
{
}
```
<br/>

```php
/**
 * Create a new product
 * @path /
 */
public function postProducts(Context $context)
{
}
```
<br/>

```php
/**
 * GET the product
 * @path /[:id]
 */
public function getProduct(Context $context)
{
}
```
<br/>

```php
/**
 * DELETE the product
 * @path /[:id]
 */
public function getProduct(Context $context)
{
}
```

## Verb only method name
And you can have a route with only the verb.
```php
public function get(Context $context)
{
}

public function post(Context $context)
{
}
```
Of course, this is just a sample. Best way to do a resourceful design in Exedra, is through a subrouting.
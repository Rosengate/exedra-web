# Installation
## Table of Contents
---
- [Introduction](#introduction)
- [Via Service Provider](#add-via-service-provider)
- [Via Routing Factory](#add-via-routing-factory)
- [Enable Caching](#enable-caching)
- [Root Controller](#root-controller)

---

## Introduction
A Minimal annotation and reflection based anemic routeful controller for Exedra. In a simple word, a routeable-action-controller component in steroid.

Writing a lot of `\Closure` for your deep nested routing can get messier and not so IDE-friendly as they grow much bigger. 
This package is built to tackle the issue and give you a nice routing controller over your routing groups. 
The controller is anemic, flattened and incapable of construction (being a protected ```__construct```), but knows very well about the routing design.

The annotation design is fairly simple, just a `@property value` mapping. Nothing much!

*p/s : Originally developed as a separate package on https://github.com/exedron/routeller (now deprecated)*

## Add via service provider
Setup the service provider
```php
// your application instance
$app->provider->add(\Exedra\Routeller\RoutellerProvider::class);
```

## Add via routing factory
Alternatively, you may manually add the handler, and set up additional things.
```php
$app->routingFactory->addGroupHandler(new \Exedra\Routeller\Handler($app));

$app->map->addExecuteHandler('routeller_execute', ExecuteHandler::class);
```

## Enable caching
Enable a file based cache
```php
$options = array(
    'auto_reload' => true
);

$cache = new \Exedra\Routeller\Cache\FileCache(__DIR__ .'/routing_caches')

$app->provider->add(new \Exedra\Routeller\Provider($cache, $options));
```
The ```auto_reload``` option lets it reload the cache each time there's some change to the controllers.

## Root Controller
This setup method allows you to alternatively initialize your root routing through a controller itself.
```php
use Exedra\Routeller\RoutellerRootProvider;
use App\Controllers\RootController;

$app->provider->add(new RoutellerRootProvider(RootController::class));
```
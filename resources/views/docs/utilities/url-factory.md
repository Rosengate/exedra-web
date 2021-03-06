# URL Factory
## Table of Contents
- [Creating Urls](#creating-urls)
- [URL Object](#url-object)

---

This component (`Exedra\Url\UrlFactory`) helps you with url creation, routing url routing resolve and so on. Available in both `Exedra\Application` and `Exedra\Runtime\Context`.

## Creating Urls

All methods of this factory return ```Exedra\Url\Url```.


### ```UrlFactory::route(string $routeName)```

Generate a ```Exedra\Url\Url``` for given route
```
$url = $context->url->route('@web.about-me');
```

### `UrlFactory::current()`
Generate a current url
```
$url = $context->url->current();
```

### `UrlFactory::previous()`
Generate a previous url
```
$url = $context->url->previous();
```

### `UrlFactory::to(string $path)`
Generate a url to given path
```
$url = $context->url->to($path);
```

## URL Object
`Exedra\Url\Url`

Aside from the factory, you can also benefit a lot from the object it returned.

### `Url::getQueryParams()`

Get URL query parameters

```
$url = $context->url->current();

$params = $url->getQueryParams();
```
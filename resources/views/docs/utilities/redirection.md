# Redirection
```Exedra\Runtime\Redirect```

This component help with redirection response.

### `Redirect::to(string $url)`

Redirect to given url.
```
return $context->redirect->to($url);
```

### `Redirect::route(string $route)`

Redirect to given route
```
return $context->redirect->route('@foo.bar');
```

### `Redirect::previous()`

Redirect to previous location. (`HTTP_REFERER`)
```
return $context->redirect->previous();
```

### `Redirect::refresh()`

Refresh page
```
return $context->redirect->refresh();
```
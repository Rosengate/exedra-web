# Minimal Setup
Exedra by the most basic design is just an application made of a service container, request, and response object, a router, a context, and some other minor things like
- ```Exedra\Path```
- ```Exedra\Url\UrlFactory```
- ```Exedra\Routing\Factory```

### Hello world bootstrap
Create a file called ```app.php```. (any file name is cool)
```php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);

$app->map['hello']->get('/')->execute(function()
{
    return 'hello world';
});

return $app;
```

### Dispatch
Then create a ```/public/index.php``` as the front controller in order to test your app.
```php
<?php
$app = require_once __DIR__.'/../app.php';

$app->dispatch();
```
And simply test it with the built-in php server.
```
cd public
php -S localhost:8080
```

Then, run the http://localhost:8080 on your browser and get your ```hello world```;
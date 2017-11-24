# Minimal Setup

## Table of Contents
---
- [Hello world bootstrap](#hello-world-bootstrap)
- [Dispatch](#dispatch)

---

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
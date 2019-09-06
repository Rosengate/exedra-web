# Minimal Setup

## Table of Contents
---
- [Autoloading src](#autoloading-src)
- [Hello world bootstrap](#hello-world-bootstrap)
- [Front  Controller](#front-controller)
- [Hello World](#hello-world)

---

### Autoloading src
Create and autoload your src or app folder, which is where all namespaced classes reside
```json
"autoload": {
    "psr-4": {"App\\": "src/"}
  }
```
Then run `composer update`


### Hello world bootstrap
Create a file called ```app.php```. (any file name is cool). Below is the most basic hello world app we can write.
```php
require_once __DIR__.'/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);

$app->map['hello']->get('/')->execute(function () {
    return 'hello world';
});

return $app;
```

### Front controller
Then create a ```/public/index.php``` as the front controller in order to test your app.

```php
<?php
$app = require_once __DIR__ . '/../app.php';

$app->dispatch();
```

### Hello World
And simply test it with the built-in php server.
```console
cd public
php -S localhost:8080
```

Then, run the http://localhost:8080 on your browser and get your ```hello world```;


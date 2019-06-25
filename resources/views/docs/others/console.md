# Console
As of now there's only two symfony console commands namely to list your routes, or start up php server.

## Setup
### composer
```
composer require symfony/console ~3.0
```

### console file
Create a file called ```console.php```, get the ```Exedra\Application``` instance from your main `app.php` file (or by whatever means). And add the provider for the service.
```php
<?php
/** @var \Exedra\Application $app */
$app = require_once __DIR__ . '/app.php';

$app->provider->add(\Exedra\Console\ConsoleProvider::class);

$app->console->run();
```

## Run
run the symfony console application
```
php console.php
```
Or specifically
```
php console.php app:routes
```

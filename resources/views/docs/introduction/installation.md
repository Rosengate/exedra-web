# Installation

You may install exedra using any of the following ways.
But, first create your project folder and change directory into the folder.

### Composer
Composer is a modern tool that helps you with package management, if you don't have one yet, please do so by visiting their site and install. It's recommended to do this way.

```
composer require rosengate/exedra dev-master
```

### Git Clone
You may git clone and then do the autoloading by your own if you want, or use ours.

```
git clone https://github.com/rosengate/exedra
```

To use our autoloader.
```php
<?php
require_once __DIR__.'/path/to/Exedra/Path.php';

\Exedra\Support\Autoloader::getInstance()->autoloadPsr4('Exedra\\', __DIR__ . '/path/to/exedra/src');
```
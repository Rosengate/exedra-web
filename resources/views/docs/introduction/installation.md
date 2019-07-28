# Installation
## Table of Contents
---
- [Composer](#composer)

---

### Composer
Composer is a modern tool that helps you with package management, if you don't have one yet, get it from [here](https://getcomposer.org/download). It's recommended to do this way.

```
composer require rosengate/exedra dev-master
```

### Autoload
Create a file called `app.php`
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = new \Exedra\Application(__DIR__);

// your codes..
```

More information on how to set up your project can be found on the next topic


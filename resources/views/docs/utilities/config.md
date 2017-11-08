# Config
`Exedra\Config`

A dot notation configuration bag, with sets of common methods. Initially available in both `Exedra\Application` and `Exedra\Runtime\Context`.

### `Config::get(string $name)`
Get the config value
```
$app->config->get('myname');
```

### `Config::set(string $name, mixed $value)`
Set value
```
$context->config->set('myname', 'jack');
```

### `Config::has(string $name)`
Check existence
```
if($app->config->has('env'))
    return 'yes';
```

## Dot notation array config

The dot notation allows you to access array value of the config without much hassle.
```
$app->config->set('db', array(
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'db' => 'qreazy'
));
```
For eg, below code will yield `localhost`
```
$host = $app->config->get('db.host');
```
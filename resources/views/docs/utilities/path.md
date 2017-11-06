# Path
`Exedra\Path`

A registry of directory locations. This component is initially available in both `Exedra\Application` and `Exedra\Runtime\Context` instance as a service.

Both `$app->path` and `$context->path` imply the root `__DIR__` of the application.

### `Path::to(string $location) : string`
Location string path relative to the instance.
```
$path = $app->path->to('to/somewhere');
```

### `Path::create(string $location) : Exedra\Path`
Create a `Exedra\Path` relative to the instance.
```
$path = $context->path->create('to/somewhere');
```

### `Path::getContents(string $file) : string`
Get contents of the given location.
```
$contents = $path->getContents('some/file.json');
```

### `Path::putContents(string $contents)`
Put contents to given location.
```
$path->putContents('some/file.json', 'foo');
```

### `Path::isExists(string $location)`
Check if given location exists (file / folder)
```
if($path->isExists('some/file.json'))
    return 'yes';
```
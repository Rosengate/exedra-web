# Service Provider

There might be a moment you want to create a package for exedra, or as provider to bridge with existing packages out there.
It could also be used to provision your own services.

### Implementation
Implement the `\Exedra\Contracts\Provider\Provider`

```php
<?php
//.. sample provider
namespace Taskful\Support;

class Provider implements \Exedra\Contracts\Provider\Provider
{
	public function register(\Exedra\Application $app)
	{
		$app['service']->add('task.manager', function()
		{
			$config = $this->config->get('taskful');

			return new \Taskful\Manager($config);
		});
	}
}
```
Then register the provider.
```php
$app->provider->add(\Taskful\Support\Provider::class);
```
Or if you prefer an instanced one, which depends on the implementation.
```
$app->provider->add(new \Taskful\Support\Provider);
```
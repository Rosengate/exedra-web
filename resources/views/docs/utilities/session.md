# Session
`Exedra\Session\Session`

A dot notated native session manager. Initially not included.

## Setup

Add this service (along with ```Exedra\Session\Flash``` service) through provider.
```
$app->provider->add(\Exedra\Session\SessionProvider::class);
```

## Usages
### `Session::set(string $key, mixed $value)`
Set session.
```
$context->session->set('user_id', $userId);
```

### `Session::get(string $key)`
Get session value.
```
$userId = $context->session->get('user_id');
```

### `Session::has(string $key)`
Check existence
```
if(!$context->session->has('user_id'))
    throw new \Exception('User is not logged in!');
```

## Multidimensional key
This session manager basically uses array by dot notation separator.

For example, you have these keys :
```
// set different key on the same parent key
$context->session->set('user.name', 'Daniel');
$context->session->set('user.email', 'dan23@gmail.com');
```

Getting session with```user``` key would yield an array that contains both ```user.name``` and `user.email` values.

Doing below :
```
print_r($context->session->get('user');
```
Will output :
```
Array
(
    [name] => Daniel
    [email] => dan23@gmail.com
)
```
### Deletion
Deleting ```user``` key would basically delete both `user.name` and `user.email` key.
```
$context->session->destroy('user');
```
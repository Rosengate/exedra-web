# Session
`Exedra\Session\Session`

A dot notated native session manager. Initially not included.

## Table of Contents
---
- [Setup](#setup)
- [Usages](#usages)
- [Multidimensional Key](#multidimensional-key)
- [Flash](#flash)

---

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

# Flash
`Exedra\Session\Flash`

An information that last a single request through the use of session. Useful for passing information to the next request.

### `Flash::set(string key, mixed value)`

Set flash value

```
$context->flash->set('message', 'Successful!');
```

### `Flash::get(string key)`

Get flash value

```
echo $context->flash->get('flash');
```

### `Flash::has(string key)`

Check whether flash value exists

```
<?php if($context->flash->has('success')):>
<div><?php echo $context->flash->get('success');?></div>
<?php endif;?>
```

### `Flash::clear()`

Clear flash data

```
$context->flash->clear();
```

Clear single data
```
$context->flash->clear('message')
```
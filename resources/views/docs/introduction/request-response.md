# Request And Response
## Table of Contents
---
- [Server Request](#server-request)
- [Response](#response)

---

These components implement psr-7 message interfaces.

## Server Request
`Exedra\Http\ServerRequest`

Available in both `Exedra\Application` and `Exedra\Runtime\Context`. 

### `ServerRequest::getMethod()`
Get request method
```
$method = $context->request->getMethod();
```
### `ServerRequest::getQueryParams()`
Get GET parameters
```
$params = $context->request->getQueryParams();
```

### `ServerRequest::getParsedBody()`
Get POST parameters
```
$params = $context->request->getParsedBody()
```

### `ServerRequest::param(string name)`
Get a merged query / parsed body parameters.
```
$username = $context->request->param('username');
```

### `ServerRequest::getUploadedFile(string key)`
Get `Exedra\Http\UploadedFile`. This http component defines a normalized `$_FILES[key]` information.
```
$uploadedFile = $context->request->getUploadedFile('my_image');

if(in_array($uploadedFile->getType(), ['image/png'])) {
    $uploadedFile->moveTo($context->path->to('uploads/my_image.png'));
}
```

### `ServerRequest::isAjax()`
Check whether request is an ajax
```
if($context->request->isAjax()) {
    // do something..
}
```

### `ServerRequest::getUri()`
Get request URI `Exedra\Http\Uri`.
```
$uri = $context->request->getUri();
```

### `ServerRequest::getHeaderLine(string name)`
Get header information
```
$type = $context->request->getHeaderLine('Content-Type');
```

For more information, refer `Exedra\Http\ServerRequest` component or `\Psr\Http\Message\ServerRequestInterface` itself.

## Response
`Exedra\Runtime\Response`

Available only in `Exedra\Runtime\Context`.

### `Response::setStatus(int code, string reason = null)`
Set response status
```
$context->response->setStatus(404);
```

### `Response::setHeader(string name, string value)`
Set response header
```
$context->response->setHeader('Content-Type', 'application/json');
```
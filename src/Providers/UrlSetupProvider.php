<?php
namespace Exedra\Web\Providers;

use Exedra\Application;
use Exedra\Contracts\Provider\Provider;
use Exedra\Url\UrlFactory;

class UrlSetupProvider implements Provider
{
    public function register(Application $app)
    {
        $app->url->addCallable('asset', function(UrlFactory $urlFactory, $path) {
            return '/assets/' . $path;
        });
    }
}
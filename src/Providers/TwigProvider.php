<?php
namespace Exedra\Web\Providers;

use Exedra\Application;
use Exedra\Contracts\Provider\Provider;

class TwigProvider implements Provider
{
    public function register(Application $app)
    {
        $app->set('@twig', function(Application $app) {
            $loader = new \Twig_Loader_Filesystem($app->path->to('resources/views'));

            return new \Twig_Environment($loader);
        });
    }
}
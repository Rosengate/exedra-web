<?php
namespace Exedra\Web;

use Exedra\Web\Controllers\WebController;
use Exedra\Web\Providers\TwigProvider;
use Exedra\Web\Providers\UrlSetupProvider;
use Exedron\Routeller\RoutellerProvider;

class Application extends \Exedra\Application
{
    public function setUp()
    {
        parent::setUp();

        $this->setUpRouting();

        $this->setUpProviders();

        $this['factory']->set('runtime.context', Context::class);
    }

    protected function setUpProviders()
    {
        $this->provider->add(TwigProvider::class);
        $this->provider->add(RoutellerProvider::class);
        $this->provider->add(UrlSetupProvider::class);
    }

    protected function setUpRouting()
    {
        $this->map['web']->any('/')->group(WebController::class);
    }
}
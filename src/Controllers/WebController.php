<?php
namespace Exedra\Web\Controllers;

use Exedra\Web\Context;

class WebController extends BaseController
{
    /**
     * @path /
     */
    public function get(Context $context)
    {
        return $context->twig->render('index.twig', array(
            'url' => $context->app->url
        ));
    }

    /**
     * @path /docs
     */
    public function groupDocs()
    {
        return DocController::class;
    }
}
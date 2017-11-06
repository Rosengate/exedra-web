<?php
namespace Exedra\Web\Controllers;

use Exedra\Web\Context;

class DocController extends BaseController
{
    public function middleware(Context $context)
    {
        $context->twig->addGlobal('context', $context);
        $context->twig->addGlobal('url', $context->url);

        return $context->next($context);
    }

    /**
     * @name index
     * @path /
     */
    public function get(Context $context)
    {
        return $context->forward('default', array('view' => 'introduction/installation'));
    }

    /**
     * @path /*:view
     * @name default
     */
    public function getDefault(Context $context)
    {
        $view = $context->param('view');

        $twigPath = null;
        $contents = null;

        // check if md file exists
        if (($mdFile = $context->path->file('resources/views/docs/' . $view . '.md')) && $mdFile->isExists()) {
            $parsedown = new \Parsedown();

            $contents = $parsedown->text($mdFile->getContents());
        } else if ($context->path->file('resources/views/docs/' . $view . '.twig')->isExists()) {
            $twigPath = 'docs/' . $view . '.twig';
        }

        return $context->twig->render('doc.twig', array(
            'menu' => json_decode($context->path->file('resources/doc_menu.json')->getContents(), true),
            'twig_path' => $twigPath,
            'contents' => $contents
        ));
    }
}
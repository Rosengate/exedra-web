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

        $routeProperties = array(
            'method' => array(
                'description' => 'An HTTP Method. It can be a single method, or multiple method or any. Not specifying any will set the method to <code>any</code>.',
                'value' => array('<code>string</code>', '<code>array</code>')
            ),
            'path' => array(
                'description' => 'A string of URI path for this route to be matched with URI path. A false boolean will disallow request dispatch on the route.',
                'value' => array('String of matchable URI path.', '<code>boolean</code> false')
            ),
            'ajax' => array(
                'description' => 'Boolean whether will only accept ajax request or not.',
                'value' => 'boolean'
            ),
            'execute' => array(
                'description' => 'An handler pattern to be executed once a route is found.',
                'value' => '\Closure'
            ),
            'middleware' => array(
                'description' => 'Bind a middleware to this route. Any route or it\'s childs matched will stack a middleware on runtime.',
                'value' => array('<code>\\Closure</code>', '<code>string</code> of class name.')
            ),
            'subroutes' => array(
                'description' => 'Define the group under this route',
                'value' => array('<code>array</code>', '<code>\Closure</code> that receives a routing group.')
            ),
            'tag' => array(
                'description' => 'A referable tag for latter route lookup, like through url generator or route based execution.',
                'value' => 'string'
            ),
            'attributes' => array(
                'description' => 'A key value component which can be retrieved through <code>Exedra\Runtime\Context::attr($key)</code>',
                'value' => 'array'
            ),
            'base' => array(
                'description' => 'The base of routing the subroutes will be based on, on finding them within execution context like url generation, and route name based execution. If boolean true is specified, it will base the finding on the current route.',
                'value' => array('<code>true</code>', '<code>string</code> route name')
            ));

        return $context->twig->render('doc.twig', array(
            'menu' => json_decode($context->path->file('resources/doc_menu.json')->getContents(), true),
            'twig_path' => $twigPath,
            'contents' => $contents,
            'route_properties' => $routeProperties
        ));
    }
}
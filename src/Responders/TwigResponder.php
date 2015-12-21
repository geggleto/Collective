<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-21
 * Time: 12:01 PM
 */

namespace Collective\Responders;


use Slim\Views\Twig;

class TwigResponder
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function render($response, $template, $data = [])
    {
        return $this->view->render($response, $template, $data);
    }
}
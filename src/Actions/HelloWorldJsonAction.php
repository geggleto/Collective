<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-21
 * Time: 11:31 AM
 */

namespace Collective\Actions;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Geggleto\Helper\BaseAction;

class HelloWorldJsonAction extends BaseAction
{

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param array                                    $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->json->render($response, ["message" => "Hello"]);
    }
}
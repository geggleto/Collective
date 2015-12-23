<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-23
 * Time: 12:43 PM
 */

namespace Collective\Flash;

use Geggleto\Helper\BaseMiddleware;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FlashMiddleware extends BaseMiddleware
{
    protected $name;

    public function __construct (ContainerInterface $containerInterface, $name = 'flashStore')
    {
        parent::__construct($containerInterface);

        $this->name = $name;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $flashStore = $this->session->get($this->name);
        foreach ($flashStore as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }
        $this->session->put($this->name, []);

        return $next($request, $response);
    }

    public function put($name, $value) {
        $flashStore = $this->session->get($this->name);

        $flashStore[$name] = $value;

        $this->session->put($this->name, $flashStore);
    }

    public function get($name) {
        return $this->session->get($this->name)[$name];
    }

    public function getAll() {
        return $this->session->get($this->name);
    }
}
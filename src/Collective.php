<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-21
 * Time: 11:12 AM
 */

namespace Collective;


class Collective extends \Slim\App
{
    public function applyMiddleware() {
        foreach ($this->getContainer()['app-middleware'] as $mw) {
            $this->add($mw);
        }
    }

    public function applyRoutes() {
        foreach ($this->getContainer()['routes']['get'] as $pattern => $info) {

            $route = $this->get($pattern, $info['callable']);

            if (isset($info['mw']) && count($info['mw']) > 1) {
                foreach ($info['mw'] as $mw) {
                    $route->add($mw);
                }
            }

            if (!empty($info['name'])) {
                $route->setName($info['name']);
            }
        }
    }

    /**
     * Add a custom middleware to the container under a key
     * @param $name
     * @param $func
     */
    public function addMw($name, $func) {
        $container = $this->getContainer();
        $container[$name] = $func;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-21
 * Time: 3:52 PM
 */

namespace Collective\Responders;


use Psr\Http\Message\ResponseInterface;

class JsonResponder
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array                               $data
     * @return mixed
     */
    public function render(ResponseInterface $response, $data = [])
    {
        return $response->write(json_encode($data));
    }
}
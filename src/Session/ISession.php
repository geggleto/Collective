<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-23
 * Time: 8:34 AM
 */

namespace Collective\Session;


interface ISession
{
    public function get($name);
    public function put($name, $value);
    public function queue($name, $value);
    public function has($name);
}
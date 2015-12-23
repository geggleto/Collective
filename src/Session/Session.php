<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-22
 * Time: 3:42 PM
 */

namespace Collective\Session;


class Session implements ISession
{
    public function __construct($name='collective')
    {
        session_name($name);
        session_start();
    }

    public function __get($name) {
        return $_SESSION[$name];
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function __isset ($name)
    {
        return isset($_SESSION[$name]);
    }

    public function get($name) {
        return $this->$name;
    }

    public function put($name, $value) {
        $this->$name = $value;
    }

    public function has($name) {
        return isset($this->$name);
    }

    public function queue($name, $value) {
        $this->{$name}[] = $value;
    }
}
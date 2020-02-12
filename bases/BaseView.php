<?php

namespace bases;

class BaseView extends Base
{
    private $adds = array();

    public function set($name , $val)
    {
        $this->adds[$name] = $val;
    }

    public function start($name)
    {
        extract($this->adds);

        require 'views/'.$name.'.php';
    }
}
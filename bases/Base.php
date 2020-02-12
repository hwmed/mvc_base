<?php

namespace bases;

abstract class Base
{

    protected function create($nameSpace , $className)
    {
        global $config;
        $dir = $config['root'] . $nameSpace . "/" . $className . ".php";

        if(file_exists($dir))
        {
            $obj = '\\' . $nameSpace . '\\' . $className;
            $obj = new $obj;
            return $obj;
        }
        else
        {
            throw new \Exception("controller does not exist");
        }
    }

    protected function debug($arr , $kill = true)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre";

        if($kill)
            die();
    }
}
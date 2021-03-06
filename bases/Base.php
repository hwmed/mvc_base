<?php

namespace bases;

abstract class Base
{
    
    protected $error_reporting = 1;

    protected function create($nameSpace , $className)
    {
        global $config;
        $dir = $config['root'] . $nameSpace . "/" . $className . ".php";

        if(file_exists($dir))
        {
            $obj = '\\' . $nameSpace . '\\' . $className;
            $checkObj = new \ReflectionClass($obj);

            if($checkObj->isAbstract())
            {
                throw new \Exception("class is abstract");
            }

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
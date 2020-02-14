<?php

namespace bases;

abstract class BaseController extends \bases\Base
{
    protected function loadView()
    {
        $obj = new \bases\BaseView;
        return $obj;
    }

    protected function loadModel($modelName , $tableName)
    {
        global $config;
        if(file_exists($config['root'] . "models/" . $modelName . ".php"))
        {
            $class = "\\models\\" . $modelName;
            $obj = new $class($tableName);
            return $obj;
        }
        else
        {
            throw new \Exception("model " . $modelName . " not exist.");
        }
    }
}
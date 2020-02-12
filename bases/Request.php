<?php

namespace bases;

class Request extends Base
{
    private $script;
    private $className;
    private $methodName;
    private $dataArray = null;

    public function __construct()
    {
        $this->run();
    }

    private function run()
    {
        $this->setScript();
        $this->explodeScript();
        $this->setData();
        $this->callData();
    }

    private function setScript()
    {
        $scriptName = str_replace("index.php" ,"", $_SERVER['SCRIPT_NAME']);
        $scriptName = str_replace($scriptName , "" , $_SERVER['REQUEST_URI']);

        
        if(strpos($scriptName , '?') !== false)
            $scriptName = substr($scriptName , 0 , strpos($scriptName , '?'));


        $this->script = $scriptName;
    }

    private function explodeScript()
    {
        global $config;

        $script = explode("/" , $this->script);

        $i=0;
        foreach($script as $s)
        {
            if(empty($s))
                unset($script[$i]);
            $i++;
        }
        sort($script);
        $this->script = $script;
    }

    private function setData()
    {
        global $config;
        $script = $this->script;

        switch(count($script))
        {
            case 0:
                $this->className = $config['def_class'];
                $this->methodName = "index";

            break;
            case 1:
                $this->className = $script[0];
                $this->methodName = "index";
            break;
            case 2:
                $this->className = $script[0];
                $this->methodName = $script[1];
            break;
            default:
                $this->className = $script[0];
                $this->methodName = $script[1];
                $this->dataArray = array_slice($script , 2);
            break;      
        }
    }

    private function callData()
    {
        global $config;
        
        try{
            $obj = $this->create("controllers" , $this->className);
            if(method_exists($obj , $this->methodName))
            {
                if(is_null($this->dataArray))
                {
                    call_user_func(
                        array(
                            $obj,
                            $this->methodName
                        )
                    );
                }
                else
                {
                    call_user_func_array(
                        array(
                            $obj,
                            $this->methodName
                        ),
                        $this->dataArray
                    );
                }
            }
            else
            {
                call_user_func_array(
                    array(
                        $obj,
                        "index"
                    ),
                    array($this->methodName)
                );
            }
        }
        catch(\Exception $ex)
        {
            $obj = $this->create("controllers" , $config['def_error_class']);
            call_user_func(
                array(
                    $obj,
                    "index"
                )
            );
        }
    }
}
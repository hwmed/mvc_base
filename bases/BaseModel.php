<?php

namespace bases;

class BaseModel extends Base
{
    protected  $mysqli;
    private $error_reporting = true;

    public function __construct()
    {
        global $config;

        $this->mysqli = new \mysqli($config['db_host'] ,$config['db_user'] ,$config['db_pass'] ,$config['db_name']);

        $this->mysqli->set_charset("utf8");
    }

    protected function query($query)
    {
        $resault = $this->mysqli->query($query);

        if($resault)
        {
            $arr = array();

            while($fetch = $resault->fetch_object())
                $arr[] = $fetch;

            return $arr;
        }
        else
        {
            throw new \Exception("query faild! DB err Massse: " . $this->mysqli->error);
        }
    }
}
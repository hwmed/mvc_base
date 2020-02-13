<?php

namespace bases;

class BaseModel extends Base
{
    protected  $pdo;
    private $error_reporting = 1;

    public function __construct()
    {
        global $config;

        try{
            $this->pdo = new \PDO("mysql:host=". $config['db_host'] .";dbname=" . $config['db_name'],$config['db_user'],$config['db_pass']);
            $this->pdo->exec('set names utf8');
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(\PDOException $e)
        {
            $this->showErr($e);
        }
    }

    private function showErr($e)
    {
        if($this->error_reporting)
            $this->debug($e->getMessage());
        else
            $this->debug("app stoped!!!");
    }
}
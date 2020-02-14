<?php

namespace bases;

abstract class BaseModel extends Base
{
    protected  $pdo;
    protected $tableName;
    protected $fieldsCount;

    public function __construct($tableName)
    {
        global $config;

        try{
            $this->pdo = new \PDO("mysql:host=". $config['db_host'] .";dbname=" . $config['db_name'],$config['db_user'],$config['db_pass']);
            $this->pdo->exec('set names utf8');
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->tableName = $tableName;
            $this->fieldsCount = $this->fields_count();
        }
        catch(\PDOException $e)
        {
            $this->showErr($e);
        }
        
    }

    protected function showErr($e)
    {
        if($this->error_reporting)
            $this->debug($e->getMessage());
        else
            $this->debug("app stoped!!!");
    }
    
    private function fields_count()
    {
        $q = $this->pdo->prepare("DESCRIBE ". $this->tableName);
        $q->execute();
        return count($q->fetchAll(\PDO::FETCH_COLUMN))-1;
    }
}
<?php

namespace models;

abstract class Model extends \bases\BaseModel
{
    public function query($query)
    { 
        try
        {
            $result = $this->pdo->prepare($query);

            
            $result->execute();

            $rows = array();
            while($row = $result->fetchObject())
            {
                $rows[] = $row;
            }
            return $rows;
        }
        catch(\PDOException $e)
        {
            $this->showErr($e);
        }
    }

    abstract public function insert();
    abstract public function select();
    abstract public function rowExist();
    abstract public function update();
    abstract public function delete();
}
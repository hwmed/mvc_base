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

    public function insert($arr = null)
    {
        
        if(!is_array($arr))
            throw new \Exception("insert value is not array");

        if(count($arr) != 5)
            throw new \Exception("article model given 5 fields");

        $query = 'INSERT INTO article
        ()
        VALUES (null,';

        for($i = 1; $i <= $this->fieldsCount; $i++)
        {
            $query .= " ? ";
            if($i != $this->fieldsCount)
                $query .= ",";
        }
        $query .= ')';

        try
        {
            $prepare = $this->pdo->prepare($query);
            $prepare->execute($arr);
        }
        catch(\PDOException $e)
        {
            $this->showErr($e);
        }
        
        return true;
    }

    public function exec($query)
    {
        try
        {
            $prepare = $this->pdo->prepare($query);
            $prepare->execute($arr);
        }
        catch(\PDOException $e)
        {
            $this->showErr($e);
        }
    }

    public function drop($rowId)
    {
        $query = "drop from " . $this->tableName . " where id = " . $rowId;

        $this->exec($query);
    }

    abstract public function rowExist();
    abstract public function delete();

}
<?php

namespace Mpwarfwk\Component\Database;

use Mpwarfwk\Component\Cache\Cache;

class CacheModel extends Model
{
  
    private $cache;

   
    public function __construct()
    {   
        $this->cache = new Cache();
        parent::__construct();
    }


    public function selectAllFromTable($table) 
    {
       
        $key = "allfrom".$table;

        
        if ( $this->cache-> get($key))
        {
            return $this->cache-> get($key);
        }

        $statement = $this->database->prepare("SELECT * FROM $table");
        $statement->execute();
        $result = $statement->fetchAll();

        $this->cache->set($key, $result, 30);
      
        return  $result;
    }


    public function insertInTable($query, $data) 
    {
        $statement = $this->database->prepare($query);

        foreach ($data as $key => $actualValue) 
        {
            $statement->bindValue(":$key", $actualValue);
        }


        $this->cache->delete("allfrom".$table);

        return $statement->execute();
    }

    
    public function deleteFromTable($table, $id, $value) 
    {
        $statement = $this->database->prepare("DELETE FROM $table WHERE $id = '$value' LIMIT 1");

        $this->cache->delete("allfrom".$table);

        return $statement->execute();
    }



   /* public function selectFromTable($query, $data = NULL) 
    {
        $statement = $this->database->prepare($query);
        if($data != NULL){
            foreach ($data as $key => $actualValue) {
                $statement->bindValue(":$key", $actualValue);
            }
        }
        $statement->execute();
        return $statement->fetchAll();
    }

   
  
    public function updateTable($query, $data) 
    {
        
        $statement = $this->database->prepare($query);
        foreach ($data as $key => $actualValue) {
            $statement->bindValue(":$key", $actualValue);
        }
        return $statement->execute();
    }  */
}
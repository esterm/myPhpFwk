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
       
        $columns = array("*");
        $table = "provincias";
       
        $cacheKey = $this->cache->createKey($columns, $table);
       
        if ( $this->cache-> getKey($cacheKey))
        {
            return $this->cache-> getKey($cacheKey);
        }

        $statement = $this->database->prepare("SELECT * FROM $table");
        $statement->execute();
        $result = $statement->fetchAll();

        $this->cache->setKey($cacheKey, $result, 30);
      
        return  $result;
    }


    public function selectFromTable($columns, $table, $data = null) 
    {
        $cacheKey = $this->cache->createKey($columns, $table, $data);

        if ( $this->cache-> getKey($cacheKey))
        {
            return $this->cache-> getKey($cacheKey);
        }

        $statement = $this->buildQuery($columns, $table, $data);
        $statement->execute();
        $result = $statement->fetchAll();
        
        $this->cache->setKey($cacheKey, $result, 30);

        return $result;
    }

   
    private function buildQuery($columns, $table, $data)
    {
        //It builds a query like for example: $query = "SELECT provincia FROM provincias WHERE id_provincia = :id";
        
        $query="SELECT ";

      
        for ($i=0; $i<count($columns); $i++) 
        {
           $query .= $columns[$i];

           if ($i<count($columns)-1) {
                 $query .= ", ";
           } 
        }
        

        $query .= " FROM ".$table;

        if($data != NULL)
        {
            $query.=" WHERE ";

            foreach ($data as $key => $actualValue) 
            {
                 $query .= $key ." = :". $key;
            }
        }

        $statement = $this->database->prepare($query);

        if($data != NULL)
        {
            foreach ($data as $key => $actualValue) 
            {
                $statement->bindValue(":$key", $actualValue);
            }
        }

        return $statement;
    }


    public function insertInTable($query, $data) 
    {
        $statement = $this->database->prepare($query);

        foreach ($data as $key => $actualValue) 
        {
            $statement->bindValue(":$key", $actualValue);
        }

         $this->cache->dropAll();

        return $statement->execute();
    }

    
    public function deleteFromTable($table, $id, $value) 
    {
        $statement = $this->database->prepare("DELETE FROM $table WHERE $id = '$value' LIMIT 1");

          $this->cache->dropAll();

        return $statement->execute();
    }

    public function updateTable($query, $data) 
    {
        
        $statement = $this->database->prepare($query);

        foreach ($data as $key => $actualValue) 
        {
            $statement->bindValue(":$key", $actualValue);
        }

        $this->cache->dropAll();

        return $statement->execute();
    }  
}
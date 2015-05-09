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

        $result=parent::selectAllFromTable($table);

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
      
        $result=parent::selectFromTable($columns, $table, $data = null);
        
        $this->cache->setKey($cacheKey, $result, 30);

        return $result;
    }

    public function insertInTable($query, $data) 
    {
        parent::insertInTable($query, $data);
    }

    
    public function deleteFromTable($table, $id, $value) 
    {
       parent::deleteFromTable($table, $id, $value);
    }

    public function updateTable($query, $data) 
    {
        
         parent::updateTable($query, $data) 
    }  
}
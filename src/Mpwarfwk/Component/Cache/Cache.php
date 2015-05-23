<?php

namespace Mpwarfwk\Component\Cache;


class Cache 
{
   
    private static $c;
    private $cache;
 
    public function __construct() 
    {
        $this->cache = $this->getCache();
    }

   
    private static function getCache()
    {
        if (!self::$c)
        {
          self::$c = new \Memcache();
          self::$c->addServer('localhost',11211);

          
        }
        return self::$c;
    }

    public function createKey($columns, $table, $data=null)
    {
        $key = $table."-".$columns."-".$data;

        return $key;
    }

    public function getKey($key)
    {
        $value=$this->cache->get($key);

        return $value;
    }

    public function setKey($key, $value, $ttl)
    {
        $this->cache->set($key,$value, MEMCACHE_COMPRESSED, $ttl);  
    }

    public function deleteKey($key) //si no lo llamo la cahce siempre va a estar disponible
    {
        $this->cache->delete($key);
    }

    public function dropAll() //si no lo llamo la cahce siempre va a estar disponible
    {
        $this->cache->flush();
    }
}

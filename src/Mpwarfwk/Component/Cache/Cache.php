<?php

namespace Mpwarfwk\Component\Cache;


class Cache 
{
   
    private static $cache;

 
    public function __construct() 
    {
        $this->cache = $this->getCache();
    }

   
    private static function getCache()
    {
        if (!self::$cache)
        {
          self::$cache = new Memcache();
          self::$cache->addServer('localhost',11211);

          
        }
        return self::$cache;
    }


	public function get($key)
	{
		$value=$cache->get($key);

		return $value;
	}

	public function set($key, $value, $ttl)
	{
		$cache->set($key,$value,$ttl);	
	}

	public function delete($key) //si no lo llamo la cahce siempre va a estar disponible
	{
		$cache->delete($key);
	}

}

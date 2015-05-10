<?php

namespace Mpwarfwk\Component\Redis;
use Predis\Collection\Iterator;

class Redis 
{ 
    private $client; 

    public function __construct()
    {   
        \Predis\Autoloader::register();

        $this->client = new \Predis\Client([
                'scheme'=> 'tcp',
                'host'=>'127.0.0.1',
                'port'=>6379,
            ]);
    }


    // Zset data type (ordered set of data) ----------------------------------------------------------

    public function deleteAllZSets()
    {
        $this->client->del('predis:zset');
    }

    //ZSet is an ordered set of data
    public function AddZSet($value, $key)
    {
        $this->client->zadd('predis:zset', $value, $key);
    }


    public function listAllZset()
    {
        // === Sorted set iterator based on ZSCAN ===
        //echo 'Scan codes and visits of `predis:zset`:';
        
        $zSetsArray=[];
        foreach (new Iterator\SortedSetKey($this->client, 'predis:zset') as $code => $visits) {
            //echo "$code [num. visits: $visits], ";
             $zSetsArray[$code]= (int) $visits;

        }

        return $zSetsArray;
    }

    public function incZSet($incrementFloat, $key)
    {
        $this->client->zincrby("predis:zset", $incrementFloat, $key);
    }

    
    // Hash data type --------------------------------------------------------------------------
   
           
    
    public function deleteAllHashes()
    {
         $this->client->del('predis:hash');
    }

    public function addHash($key, $par, $value)
    {
        
        $this->client ->hset($key, $par, 0);
    }

    public function deleteOneHash($key, $par)
    {
         $this->client->hdel($key, $par);

    }

    public function getHash($key, $par)
    {
        return $this->client->hget($key, $par);
    }

    public function listAllHash()
    {
        // === Hash iterator based on HSCAN ===
        echo 'Scan fields and values of `predis:hash`:', PHP_EOL;
         echo "---";
        foreach (new Iterator\HashKey($this->client, 'predis:hash') as $field => $value) {
            echo " - $field => $value", PHP_EOL;
        }
    }

  
    public function incHash($key)
    {
        $this->client ->hIncrBy('predis:hash', $key, 2); /* returns 2: h[x] = 2 now. */
    }

}

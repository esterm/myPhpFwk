<?php

namespace Mpwarfwk\Component\Sphinx;
use NilPortugues\Sphinx\SphinxClient;

class Sphinx 
{
    private $sphinx; 

    public function __construct()
    {   
        $this->sphinx = new SphinxClient();
		$this->sphinx->SetServer( '127.0.0.1', 9312);
		$this->sphinx->SetMatchMode( SPH_MATCH_EXTENDED );
		$this->sphinx->SetSortMode( SPH_SORT_RELEVANCE );
    }


    public function setLimits(  $offset, $limit, $max_matches, $cutoff=0 )
	{
    	$this->sphinx->SetLimits ($offset, $limit, $max_matches, 0 );
    }

    public function setFilter( $atr, $values )
    {
    	$this->sphinx->SetFilter( $atr, $values );
    }

    public function searchIndex( $query_string, $index )
    {
    	$this->sphinx->AddQuery( $query_string, $index );
		$results = $this->sphinx->RunQueries();

		return $results;
    }
}

<?php

namespace Mpwarfwk\Component\Routing;

use Mpwarfwk\Component\Routing\Route;

class Routing{

   private $jsonDecoded;
   private $routingPath;

   

	public function __construct()
   {
      $this->routingPath=__DIR__."/../../../../../../../config/routing.json";
      $routingStr= file_get_contents($this->routingPath);
      $this->jsonDecoded=(array) json_decode($routingStr);
   }

   public function getRoute($request)
   {
		 
		      $uriArray=explode("/",$request->url);
          $elemJson="/";
          $params=array();

          if(isset($uriArray[1]) && $uriArray[1]!="")
          {
                $controller=$uriArray[1];
                $elemJson=$elemJson.$controller;
          }

          if(isset($uriArray[2])){
                $action=$uriArray[2];
                $elemJson=$elemJson."/".$action;
          }

          if(isset($uriArray[3])){
                for($i=3;$i<count($uriArray);$i++)
                $params[]=$uriArray[$i];
          }

        
          $route=new Route( $this->jsonDecoded[$elemJson]->path,$this->jsonDecoded[$elemJson]->method,$params);
           
       
          return $route;
   }

}
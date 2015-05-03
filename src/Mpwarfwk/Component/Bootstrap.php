<?php

namespace Mpwarfwk\Component;

use \Mpwarfwk\Component\Routing\Routing;

class Bootstrap{

	protected $_dev;
  private $request;

	public function __construct($dev)
   {
       $this->_dev=$dev;
   }

   public function handle($request)
   {
        $this->request=$request;

        $routing= new Routing();
      
        $route=$routing->getRoute($this->request);
        $routeClass= $route->getRouteClass();
        $routeAction= $route->getRouteAction();
        $extraParams= $route->getRouteParams();

        $controller=new $routeClass();

        if ($routeAction!="")
        {
          $response=$controller->$routeAction($this->request,$extraParams);
        }
        else
        {
          $response=$controller->mainAction($this->request,$extraParams);
        }
        return $response;
   }
   
}
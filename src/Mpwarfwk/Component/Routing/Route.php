<?php
namespace Mpwarfwk\Component\Routing;

class Route
{
    private $routeClass;
    private $routeAction;
    private $routeParams;

    public function __construct($routeClass, $routeAction,$routeParams=array())
    {
        $this->routeClass  = $routeClass;
        $this->routeAction =  $routeAction;
        $this->routeParams =  $routeParams;

    }

  
    public function getRouteClass()
    {
        return $this->routeClass;
    }

    public function getRouteAction()
    {
        return $this->routeAction;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }
}

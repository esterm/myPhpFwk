<?php

namespace Mpwarfwk\Component;

use Mpwarfwk\Component\Container\Container;

abstract class BaseController {
    
    public $container;

    public function __construct() {

        $this->container=new Container();
    }

  


  

        
}
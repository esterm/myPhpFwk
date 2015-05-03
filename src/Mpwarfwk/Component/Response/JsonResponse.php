<?php

namespace Mpwarfwk\Component\Response;

use Mpwarfwk\Component\Response\Response;


class JsonResponse extends Response {
  

   public function __construct($body = '')
    {
      
        parent::__construct($body,null,null);
        $this->setHeader('Content-Type', 'application/json');
    }


    //Adds a header to the response
    public function setHeader($name, $value = null) {
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->headers[$k] = $v;
            }
        }
        else {
            $this->headers[$name] = $value;
        }

        return $this;
    }
  
    public function getHeader($name)
    {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }



   
}


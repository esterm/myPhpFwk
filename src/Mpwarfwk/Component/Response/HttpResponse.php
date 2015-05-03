<?php

namespace Mpwarfwk\Component\Response;

use Mpwarfwk\Component\Response\Response;


class HttpResponse extends Response {
  

   public function __construct($body = '', $status = 200, $headers = array())
    {
        parent::__construct($body,$status,$headers);
        $this->setHeader('Content-Type', 'text/html');
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


<?php

namespace Mpwarfwk\Component\Templating;


use Twig;


class TwigRenderClass {
	
	public $view;
	public $routetemplates;
	public $loader;

	public function __construct()
	{ 
		$this->routetemplates=__DIR__."/../../../../../../../src/Templates";;
		$this->loader = new \Twig_Loader_Filesystem( $this->routetemplates);
		$this->view = new \Twig_Environment( $this->loader, array() );
	}	

}
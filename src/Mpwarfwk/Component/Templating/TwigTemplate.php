<?php

namespace Mpwarfwk\Component\Templating;

use Mpwarfwk\Component\Templating\iTemplating;

use Twig;


class TwigTemplate implements iTemplating{
	
	private $renderclass;
	private $template;
	private $variables;

	public function __construct(TwigRenderClass $renderclass)
	{ 
		$this->renderclass=$renderclass;
	}

	public function renderTemplate($template,$vars=null)
	{
		return $this->renderclass->view->render( $template, $vars);
	}

	public function assignVars($variables)
	{
		foreach($variables as $key->$value){
			$this->renderclass->view->assign($key,$value);
		}
	}

	

}
<?php

namespace Mpwarfwk\Component\Templating;

use Mpwarfwk\Component\Templating\iTemplating;


class SmartyTemplate implements iTemplating
{
	private $smarty;

	public function __construct(\Smarty $smarty)
	{
		$this->smarty = $smarty;
	}

	public function renderTemplate($template, $variables = null)
	{
		return $this->smarty->fetch($template);
		//return $this->view->display($template);
	}

	public function assignVars($variables)
	{
		foreach ($variables as $key => $value)
		{
			$this->smarty->assign($key,$value);
		}
	}
}
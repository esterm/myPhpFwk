<?php
namespace Mpwarfwk\Component\Templating;

interface iTemplating{
	public function renderTemplate($template,$variables=null);
	public function assignVars($variables);
}
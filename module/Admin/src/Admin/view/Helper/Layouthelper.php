<?php
namespace Admin\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Layouthelper extends AbstractHelper
{
	public function __invoke($layout = '2columnas', $data)
	{
		if (! is_string($layout)){
			return 'must be string';
		}

		return $this->getView()->render($layout,array('data' => $data));
	}
}
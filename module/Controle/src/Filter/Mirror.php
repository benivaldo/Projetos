<?php
namespace Acme\Filter;

use Zend\Filter\FilterInterface;

class Mirror implements FilterInterface
{
	public function filter($value)
	{
		return strrev($value);
	}	
}
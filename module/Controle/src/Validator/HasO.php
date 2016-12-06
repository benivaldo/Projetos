<?php
namespace Controler\Validator;

use Zend\Validator\AbstractValidator;

class HasO extends AbstractValidator
{
	public function isValid($value)
	{
		$isValid = (strpos($value,'o')!== false);
		 
		if (!$isValid)
		{
			$message = 'Has not O';
			$translator = self::$defaultTranslator;
			$message = $translator->translate($message); 
			$this->abstractOptions['messages'][] =
			$message;
		}
		
		return $isValid;
	}
}
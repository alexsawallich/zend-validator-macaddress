<?php

namespace AlexSawallich\Validator;

use Zend\Validator\AbstractValidator;

class MacAddress extends AbstractValidator
{
	public function isValid($value)
	{
		return false;
	}
}

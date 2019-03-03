<?php

namespace AlexSawallich\Validator;

use Zend\Validator\AbstractValidator;

class MacAddress extends AbstractValidator
{
	const INVALID_MAC_ADDRESS = 'invalid_mac_address';
	
	const INVALID_TYPE = 'invalid_type';
	
	protected $messageTemplates = [
		self::INVALID_MAC_ADDRESS => 'The given input doesn\'t appear to be a valid MAC address.',
		self::INVALID_TYPE => "Invalid type given. String expected",
	];
	
	protected $options = [
		'allowDashNotation' => true,
		'allowColonNotation' => true,
		'allowUnseparatedNotation' => true,
		'allowUppercase' => true,
		'allowLowercase' => true
	];
	
	public function isValid($value)
	{
		if (false === is_string($value)) {
			$this->error(self::INVALID_TYPE);
			return false;
		}
		
		$pattern = $this->getPattern();
		if (!preg_match($pattern, $value)) {
			$this->error(self::INVALID_MAC_ADDRESS);
			return false;
		}
		
		return true;
	}
	
	protected function getPattern()
	{
		$numbers = '0-9';
		$chars = '';
		$separators = [];
		
		if (true == $this->options['allowUppercase']) {
			$chars .= 'A-F';
		}
		
		if (true == $this->options['allowLowercase']) {
			$chars .= 'a-f';
		}
		
		if (true == $this->options['allowColonNotation']) {
			$separators[] = ':';
		}
		
		if (true == $this->options['allowDashNotation']) {
			$separators[] = '-';
		}
		
		$separators = '(' . implode('|', $separators) . ')';
		
		if (true == $this->options['allowUnseparatedNotation']) {
			$separators .= '?';
		}
		
		return '#([' . $numbers . $chars . ']{2}' . $separators . '){6}#';
	}
}

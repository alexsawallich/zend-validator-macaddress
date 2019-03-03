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
	
	public function getAllowColonNotation() : bool
	{
		return $this->options['allowColonNotation'];
	}
	
	public function setAllowColonNotation(bool $allowColonNotation)
	{
		$this->options['allowColonNotation'] = $allowColonNotation;
		return $this;
	}
	
	public function getAllowDashNotation() : bool
	{
		return $this->options['allowDashNotation'];
	}
	
	public function setAllowDashNotation(bool $allowDashNotation)
	{
		$this->options['allowDashNotation'] = $allowDashNotation;
		return $this;
	}
	
	public function getAllowLowercase() : bool
	{
		return $this->options['allowLowercase'];
	}
	
	public function setAllowLowercase(bool $allowLowercase)
	{
		$this->options['allowLowercase'] = $allowLowercase;
		return $this;
	}
	
	public function getAllowUnseparatedNotation() : bool
	{
		return $this->options['allowUnseparatedNotation'];
	}
	
	public function setAllowUnseparatedNotation(bool $allowUnseparatedNotation)
	{
		$this->options['allowUnseparatedNotation'] = $allowUnseparatedNotation;
		return $this;
	}
	
	public function getAllowUppercase() : bool
	{
		return $this->options['allowUnseparatedNotation'];
	}

	public function setAllowUppercase(bool $allowUppercase)
	{
		$this->options['allowUppercase'] = $allowUppercase;
		return $this;
	}
	
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
		
		$pattern = '#^([' . $numbers . $chars . ']{2}' . $separators . '){5}([' . $numbers . $chars . ']{2})$#';
		return $pattern;
	}
}

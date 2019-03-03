<?php
use PHPUnit\Framework\TestCase;
use AlexSawallich\Validator\MacAddress;

class MacAddressTest extends TestCase
{
	public function testAllowedCharactes()
	{
		$validator = new MacAddress();
		$this->assertEquals(false, $validator->isValid('ZY:GT:%$:§":CD:65'));
		
		$validator = new MacAddress();
		$this->assertEquals(true, $validator->isValid('AB:CD:EF:01:23:45'));
		
		$validator = new MacAddress();
		$this->assertEquals(true, $validator->isValid('67:89:01:23:45:67'));
		
		$validator = new MacAddress();
		$this->assertEquals(false, $validator->isValid('AB:CD:EF:01:23:4Z'));
	}
	
	public function testCasingOptions()
	{
		$validator = new MacAddress();
		$this->assertEquals(true, $validator->isValid('Ab:11:11:11:11:11'));
		
		$validator = new MacAddress(['allowUppercase' => false, 'allowLowercase' => true]);
		$this->assertEquals(false, $validator->isValid('Ab:11:11:11:11:11'));
		$this->assertEquals(true, $validator->isValid('ab:11:11:11:11:11'));
		
		$validator = new MacAddress(['allowLowercase' => false, 'allowUppercase' => true]);
		$this->assertEquals(false, $validator->isValid('Ab:11:11:11:11:11'));
		$this->assertEquals(true, $validator->isValid('AB:11:11:11:11:11'));
	}
	
	public function testSeparatorOptions()
	{
		$validator = new MacAddress();
		$this->assertEquals(true, $validator->isValid('11:11:11:11:11:11'));
		$this->assertEquals(true, $validator->isValid('11-11-11-11-11-11'));
		$this->assertEquals(true, $validator->isValid('111111111111'));
		
		$validator = new MacAddress(['allowDashNotation' => true, 'allowColonNotation' => false, 'allowUnseparatedNotation' => false]);
		$this->assertEquals(false, $validator->isValid('11:11:11:11:11:11'));
		$this->assertEquals(true, $validator->isValid('11-11-11-11-11-11'));
		$this->assertEquals(false, $validator->isValid('111111111111'));
		
		$validator = new MacAddress(['allowDashNotation' => false, 'allowColonNotation' => true, 'allowUnseparatedNotation' => false]);
		$this->assertEquals(true, $validator->isValid('11:11:11:11:11:11'));
		$this->assertEquals(false, $validator->isValid('11-11-11-11-11-11'));
		$this->assertEquals(false, $validator->isValid('111111111111'));
		
		$validator = new MacAddress(['allowDashNotation' => false, 'allowColonNotation' => false, 'allowUnseparatedNotation' => true]);
		$this->assertEquals(false, $validator->isValid('11:11:11:11:11:11'));
		$this->assertEquals(false, $validator->isValid('11-11-11-11-11-11'));
		$this->assertEquals(true, $validator->isValid('111111111111'));
	}
}

[![Build Status](https://travis-ci.org/alexsawallich/zend-validator-macaddress.svg?branch=master)](https://travis-ci.org/alexsawallich/zend-validator-macaddress)

# zend-validator-macaddress

Validation class to validate MAC addresses for plugging in right into Zend Framework 3.


## Installation

The validator can be installed via composer as it is registered with packagist:

```
composer require alexsawallich/zend-validator-macaddress
```


## Getting started

The simplest way of using the validator looks as follows:

```
<?php
$validator = new AlexSawallich\Validator\MacAddress();
$isValid = $validator->isValid('FE:34:ED:32:2F:F4');
var_dump($isValid);
if (false === $isValid) {
	var_dump($validator->getMessages());
}
```


## Options

The validator comes with a variety of options. All these options are set to `true` by default. The options
can be typically given into the constructor as array, as you could do with all zend validator classes.

For each options there's also a getter and a setter method, like `setAllowColonNotation()`.

|Option|Type|Default|Description
|---   |--- |---    |---
|`allowColonNotation`|`bool`|`true`|Allows the colon (`:`) as valid separator, like `AB:CD:EF:01:23:45`.
|`allowDashNotation`|`bool`|`true`|Allows the dash (`-`) as valid separator, like `AB-CD-EF-01-23-45`.
|`allowUnseparatedNotation`|`bool`|`true`|Allows the use of no separator at all, like `ABCDEF012345`.
|`allowLowercase`|`bool`|`true`|Allows the use of lowercase chars, like `ab:cd:ef:01:23:45`.
|`allowUppercase`|`bool`|`true`|Allows the use of uppercase chars, like `AB:CD:EF:01:23:45`.

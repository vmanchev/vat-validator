# VAT validator

Validate a VAT number against the official European Commission VIES VAT number validation SOAP service.

## Prerequisites
1. PHP version 7 and above.
2. php7.x-soap extension

## How to install 

<pre>
composer require "toxicdigital/vat-validator"
</pre>

## How to use

<pre>

use Toxic\Validator\Vat as VatValidator;

$validator = VatValidator::getInstance();

//Returns true or false
$validator->isValid("XY123456789");

//If VAT number is valid, company info is available
$validator->getCompany();

/*
 * Toxic\Validator\Vat\Company Object
 * (
 *   [name] => John Doe
 *   [address] => 123 Main St, Anytown, UK
 *   [vatNumber] => 100
 *   [countryCode] => GB
 *   [valid] => true
 * )
 */

</pre>

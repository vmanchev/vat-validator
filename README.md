# VAT validator

Validate a VAT number against the official European Commission VIES VAT number validation SOAP service.

## How to install 

TBD

## How to use

<pre>
<?php

use Toxic\Validator\Vat as VatValidator;

$validator = VatValidator::getInstance();

//Returns true or false
$validator->isValid("XY123456789");

//If VAT number is valid, company info is available
$validator->getCompany();

</pre>

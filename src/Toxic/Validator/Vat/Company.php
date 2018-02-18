<?php

namespace Toxic\Validator\Vat;

class Company
{

  public $name;
  public $address;
  public $vatNumber;
  public $countryCode;
  public $valid;

  public function isValid(): bool {
    return $this->valid;
  }

}

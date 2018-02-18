<?php

namespace Toxic\Validator;

use Toxic\Validator\Vat\Company;

class Vat
{

  const config = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';

  private static $instance;
  private $client;
  private $company;

  private function __construct() {
    $this->client = new \SoapClient(self::config, [
        'exceptions' => false
    ]);
    $this->company = new Company();
  }

  public static function getInstance(): \Toxic\Validator\Vat {

    if (!isset(static::$instance)) {
      static::$instance = new Vat();
    }

    return static::$instance;
  }

  public function isValid(string $code): bool {

    $code = $this->filter($code);

    $result = $this->client->checkVat([
        'countryCode' => $this->getCountryCode($code),
        'vatNumber' => $this->getVatNumber($code)
    ]);

    if ($result instanceof \SoapFault) {
      return false;
    }

    return $this->setCompany($result)->isValid();
  }

  private function filter(string $code): string {

    $code = strtoupper($code);
    $code = filter_var($code, FILTER_SANITIZE_STRING);
    $code = preg_replace("/[^A-Z0-9]/", "", $code);

    return trim($code);
  }

  private function getCountryCode(string $code): string {
    return substr($code, 0, 2);
  }

  private function getVatNumber(string $code): string {
    return substr($code, 2);
  }

  private function setCompany(\stdClass $data): Company {

    foreach ($this->company as $property => $value) {
      if (!isset($data->{$property})) {
        continue;
      }

      $this->company->{$property} = $data->{$property};
    }

    return $this->company;
  }

  public function getCompany(): Company {
    return $this->company;
  }

}

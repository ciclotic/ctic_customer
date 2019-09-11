<?php
namespace CTIC\Customer\Customer\Domain;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Domain\IdentifiableInterface;

interface CustomerAddressInterface extends IdentifiableInterface, EntityInterface
{
    public function getAddress(): string;
    public function getPostalCode(): string;
    public function getTown(): string;
    public function getProvince(): string;
    public function getCountry(): string;
    public function getPhone(): string;
    public function getContactPerson(): string;
    public function getCustomer();
    public function setCustomer(Customer $customer): bool;
}